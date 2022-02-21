<?php

namespace backend\controllers;

use common\models\Dadospessoais;
use yii\data\ActiveDataProvider;
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
    protected function findModel($id)
    {
        if (($model = Dadospessoais::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
