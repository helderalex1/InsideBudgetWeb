<?php

namespace frontend\controllers;

use common\models\Questao;
use common\models\Resposta;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RespostaController implements the CRUD actions for Resposta model.
 */
class RespostaController extends Controller
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
                    'rules' => [
                        [
                            'actions' => ['index', 'create', 'view', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['instalador','fornecedor'],
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
     * Lists all Resposta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Resposta::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resposta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->identity->getId()) {
            return $this->render('view', [
            'model' => $this->findModel($id),
            ]);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    /**
     * Creates a new Resposta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resposta();
        $model->user_id = Yii::$app->user->identity->getId();
        $model->data = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $questao = Questao::findOne(['id' =>$model->questao_id]);
            $questao->respondida = 0;
            $questao->save();
            return $this->redirect(['questao/view', 'id' => $model->questao_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resposta model.
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
     * Deletes an existing Resposta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->identity->getId()) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }else{
            throw new HttpException(403, Yii::t('app', 'Você não tem permissão para realizar esta ação.'));
        }
    }

    /**
     * Finds the Resposta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resposta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resposta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
