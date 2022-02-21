<?php

namespace frontend\controllers;

use app\modules\api\controllers\AuthAssignmentController;
use app\modules\api\Module;
use http\Client;
use common\models\User;
use common\models\Dadospessoais;
use http\Message;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * DadospessoaisController implements the CRUD actions for Dadospessoais model.
 */
class DadospessoaisController extends Controller
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
                    'only' => ['dados'],
                    'rules' => [
                        [
                            'actions' => ['dados'],
                            'allow' => true,
                            'roles' => ['@'],
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

    public function actionDados()
    {
        $model = $this->findModel(Dadospessoais::findOne(['user_id'=>\Yii::$app->user->identity->getId()])->id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['dados']);
        }

        return $this->render('dados', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Dadospessoais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Dadospessoais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dadospessoais::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
