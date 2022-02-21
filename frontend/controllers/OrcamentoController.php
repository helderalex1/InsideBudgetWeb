<?php

namespace frontend\controllers;


use common\models\Dadospessoais;
use common\models\User;
use common\models\Cliente;
use common\models\Orcamento;
use common\models\Orcamentoproduto;
use common\models\Produto;
use common\models\Tipologia;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrcamentoController implements the CRUD actions for Orcamento model.
 */
class OrcamentoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'create', 'view', 'update', 'delete', 'addProduto', 'updateProduto', 'deleteProduto'],
                    'rules' => [
                        [
                            'actions' => ['index', 'create', 'view', 'update', 'delete', 'addProduto', 'updateProduto', 'deleteProduto'],
                            'allow' => true,
                            'roles' => ['instalador'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Orcamento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $lista = Yii::$app->request->post();
        if(empty($lista['nome'])){
            $lista['nome'] = '';
        }
        $orcamentos = Orcamento::find()->where(['and',['like', 'nome', $lista['nome']],['user_id'=>Yii::$app->user->identity->getId()]]);
        $dataProvider = new ActiveDataProvider([
            'query' => $orcamentos,

            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'nome' => SORT_ASC,
                ]
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orcamento model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        $selecionada =null;
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->identity->getId()) {
            $orcamento_produto = new OrcamentoProduto();
            //$produtos = Produto::find()->asArray()->all();
            $total = $orcamento_produto::find()->where(['orcamento_id' => $model->id])->asArray()->all();
            $i = 0;
            $i1 = 0;
            $totaltodo = 0.0;
            foreach ($total as $total1) {
                $total1 = Produto::find()->where(['id' => $total[$i]['produto_id']])->asArray()->all();
                foreach ($total1 as $total2) {
                    $totaltodo = $totaltodo + $total1[$i1]['preco'] * $total[$i]['quantidade'];
                }
                $i++;
            }
            $model->total = $totaltodo;
            $model->save();
            $model->total = $totaltodo . '€';
            $lista = Yii::$app->request->post();

            if (empty($lista['nome'])) {
                $lista['nome'] = '';
            }
            //return var_dump(Produto::find()->where(['LIKE','nome', 'livro'])->asArray()->all());
            if (empty($lista['listaprodutos'])) {
                $produtos = Produto::find()->where(['like', 'nome', $lista['nome']])->asArray()->all();
            } else {
                $selecionada =$lista['listaprodutos'];
                $produtos = Produto::find()->where(['and', ['LIKE', 'tipologia_id', $lista['listaprodutos']], ['like', 'nome', $lista['nome']]])->asArray()->all();
            }

            return $this->render('view', [
                'produtos' => $produtos,
                'model' => $model,
                'orcamento_produto' => $orcamento_produto,
                'selecionada' => $selecionada
            ]);
        }else{
            throw new HttpException(403, Yii::t('app', 'You are not allowed to perform this action.'));
        }
    }

    public function actionPdf($id){
        $orcamentoProduto = Orcamentoproduto::findAll(['orcamento_id'=>$id]);
        $orcamento = Orcamento::findOne(['id'=> $id]);
        $user = User::findOne(['id' => Yii::$app->user->identity->getId()]);
        $dados = Dadospessoais::findOne(['user_id'=> Yii::$app->user->identity->getId()]);
        $cliente = Cliente::findOne(['id' => $id]);

        $html = $this->renderPartial('pdf',[
            'orcamentoProdutos'=>$orcamentoProduto,
            'orcamento'=>$orcamento,
            'user' => $user,
            'dados' => $dados,
            'cliente' => $cliente]);$mpdf = new \Mpdf\Mpdf();
        $mpdf->showImageErrors =true;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html);
        $mpdf->SetFooter("Criado em " . date("d/m/Y"),'DOUBLE-SIDED');
        //$mpdf->Output('MyPDF.pdf', 'D');
        $mpdf->Output();
        exit;
    }
    /**
     * Creates a new Orcamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Orcamento();
        $model->user_id = \Yii::$app->user->identity->getId();
        $model->cliente_id = $id;
        $model->data = date("Y-m-d h:i:s");
        $model->uid = Yii::$app->security->generateRandomString(12);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orcamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->user_id == Yii::$app->user->identity->getId()) {
            $cliente_user = Cliente::find()->where(['user_id' => Yii::$app->user->identity->id])->asArray()->all();
            if($cliente_user[0]['user_id'] != $model->user_id){
                throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
            }
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    /**
     * Deletes an existing Orcamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->user_id == Yii::$app->user->identity->getId()) {
            $cliente_user = Cliente::find()->where(['user_id' => Yii::$app->user->identity->id])->asArray()->all();
            if ($cliente_user[0]['user_id'] != $model->user_id) {
                throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
            }
            $model->delete();
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    public function actionAddproduto($id){
        $model = $this->findModel($id);
        $orcamento_produto = new OrcamentoProduto();
        $addproduto1 = Yii::$app->request->post();
        foreach ($addproduto1 as $addproduto2){
            $addproduto[] = $addproduto2;
        }
        //return var_dump(Yii::$app->request->post());
        $cliente_user = Cliente::find()->where(['user_id'=> Yii::$app->user->identity->id])->asArray()->all();
        if($cliente_user[0]['user_id'] != $model->user_id){
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
        $repetidoproduto =  Orcamentoproduto::find()->where(['and',['produto_id'=>$addproduto[0]['produto_id']], ['orcamento_id'=>$model->id]])->asArray()->all();
        $repetidoproduto1 = 0;
        foreach ($repetidoproduto as $repetidoproduto1){
            $repetidoproduto1;
        }
       //return var_dump($repetidoproduto1);
        if($repetidoproduto1 ){
            //return var_dump($repetidoproduto[0]['quantidade'] + $addproduto[0]['quantidade']);
            $repetidoproduto1['quantidade'] = $repetidoproduto1['quantidade'] + $addproduto[0]['quantidade'];
           // return var_dump($repetidoproduto1);
            $guardar = Orcamentoproduto::findOne(['id'=> $repetidoproduto1['id']]);
            $guardar->quantidade= $repetidoproduto1['quantidade'];
            $guardar->save();
            //return var_dump($guardar->save());
            Yii::$app->session->setFlash('success', "Produto já existente foi adicionado mais ".  $addproduto[0]['quantidade']." quantidade com sucesso");
            return $this->redirect(Yii::$app->request->referrer);
        }elseif($orcamento_produto->load(Yii::$app->request->post()) && $orcamento_produto->save()) {
            Yii::$app->session->setFlash('success', "Produto inserido com sucesso");
            return $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('error', "Erro ao inserir produto!");
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdateproduto(){
        $post = Yii::$app->request->post();
        $post = $post["Orcamentoproduto"];
        $model = $this->findModel($post["orcamento_id"]);
        $cliente_user = Cliente::find()->where(['user_id'=> Yii::$app->user->identity->id])->asArray()->all();
        if($cliente_user[0]['user_id'] != $model->user_id){
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }

        $model = OrcamentoProduto::find()->where(['orcamento_id' => $post["orcamento_id"], 'produto_id' => $post["produto_id"]])->one();
        $model->quantidade = $post["quantidade"];
        if ( $model->save()) {
            Yii::$app->session->setFlash('info', "Produto atualizado com sucesso");
            return $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('error', "Erro ao atualizar a quantidade do produto!");
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteproduto($id, $produto){
        $model = $this->findModel($id);
        $cliente_user = Cliente::find()->where(['user_id'=> Yii::$app->user->identity->id])->asArray()->all();
        if($cliente_user[0]['user_id'] != $model->user_id){
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
        $model = OrcamentoProduto::find()->where(['orcamento_id' => $id, 'produto_id' => $produto])->one();
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', "Produto removido com sucesso");
            return $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('error', "Erro ao remover o produto selecionado.");
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Orcamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orcamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orcamento::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
