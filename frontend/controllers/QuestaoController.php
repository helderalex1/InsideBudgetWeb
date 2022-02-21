<?php

namespace frontend\controllers;


use common\models\Resposta;
use common\models\User;
use Yii;
use common\models\Questao;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestaoController implements the CRUD actions for questao model.
 */
class QuestaoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'index', 'view', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'index', 'view', 'update'],
                        'roles' => ['instalador', 'fornecedor'],
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
     * Lists all questao models.
     * @return mixed
     */
     public function actionIndex()
     {
         $model = Questao::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->asArray()->all();
         $dataProvider = new ActiveDataProvider([
             'query' => Questao::find()->where(['user_id'=>Yii::$app->user->identity->getId()]),
             'pagination' => [
                 'pageSize' => 10
             ],
             'sort' => [
                 'defaultOrder' => [
                     'id' => SORT_DESC,
                 ]
             ],
         ]);

         return $this->render('index', [
             'dataProvider' => $dataProvider,
         ]);
     }

    /**
     * Displays a single questao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionView($id)
     {
         $model = $this->findModel($id);
         if ($model->user_id == Yii::$app->user->identity->getId()) {
             $resposta = new Resposta();
             $respostas = Resposta::find()->where(['questao_id'=>$id])->asArray()->all();

             return $this->render('view', [
                 'model' => $this->findModel($id),
                 'resposta' => $resposta,
                 'respostas' => $respostas
             ]);
         }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
     }

    /**
     * Creates a new questao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Questao();
        $model->concluida = 0;
        $model->user_id = Yii::$app->user->identity->getId();
        $a = User::find()->select('email')->where(['id'=>Yii::$app->user->identity->getId()])->asArray()->one();
        $model->email = $a['email'];
        $model->data = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Questão enviada com sucesso");
            return $this->redirect(['view', 'id'=>$model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing questao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->identity->getId()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Deletes an existing questao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->identity->getId()) {
            $model->delete();
            return $this->redirect(['index']);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    /**
     * Finds the questao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
