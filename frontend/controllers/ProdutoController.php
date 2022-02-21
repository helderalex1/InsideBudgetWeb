<?php

namespace frontend\controllers;

use common\models\Produto;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
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
                    'only' => ['index', 'create', 'view', 'update', 'delete', 'meusprodutos'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['instalador'],
                        ],
                        [
                            'actions' => ['index', 'create', 'view', 'update', 'delete', 'meusprodutos'],
                            'allow' => true,
                            'roles' => ['fornecedor'],
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
     * Lists all Produto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $lista = Yii::$app->request->post();

        if(empty($lista['nome'])){
            $lista['nome'] = '';
        }
        if(empty($lista['listaprodutos'])) {
            $produtos = Produto::find()->where(['like', 'nome', $lista['nome']]);
        }else{

            $produtos = Produto::find()->where(['and', ['LIKE', 'tipologia_id', $lista['listaprodutos']], ['like', 'nome', $lista['nome']]]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $produtos,
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
     * Displays a single Produto model.
     * @param int $id ID
     * @ret urn string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
    }

    public function actionMeusprodutos()
    {
        $lista = Yii::$app->request->post();
       // return $lista['listaprodutos'];
        if(empty($lista['nome'])){
            $lista['nome'] = '';
        }
        if(empty($lista['listaprodutos'])) {
            $produtos = Produto::find()->where(['and',['like', 'nome', $lista['nome']],['fornecedor_id'=>Yii::$app->user->identity->getId()]]);
        }else{
            $produtos = Produto::find()->where(['and',['like', 'nome', $lista['nome']],['like','tipologia_id', $lista['listaprodutos']],['fornecedor_id'=>Yii::$app->user->identity->getId()]]);

            // $produtos = Produto::find()->where(['and', ['LIKE', 'tipologia_id', $lista['listaprodutos']], ['and',['like', 'nome', $lista['nome']],['like','fornecedor_id',Yii::$app->user->identity->getId()]]]);
           // return var_dump($produtos->all());
        }
      //  return var_dump($produtos->all());
        $dataProvider = new ActiveDataProvider([
            'query' => $produtos,

            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'nome' => SORT_ASC,
                ]
            ],

        ]);

        return $this->render('meusprodutos', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Produto();
        $model->fornecedor_id = \Yii::$app->user->identity->getId();
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
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->fornecedor_id == Yii::$app->user->identity->getId()) {
            if($model->fornecedor_id == \Yii::$app->user->identity->getId()) {
                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->fornecedor_id == Yii::$app->user->identity->getId()) {
            $model = $this->findModel($id);
            if($model->fornecedor_id == \Yii::$app->user->identity->getId()) {
                $model->delete();
            }
            return $this->redirect(['index']);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
