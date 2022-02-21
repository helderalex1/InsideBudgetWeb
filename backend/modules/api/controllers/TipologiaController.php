<?php

namespace app\modules\api\controllers;

use common\models\AuthAssignment;
use common\models\User;
use Yii;
use yii\rest\ActiveController;


/**
 * UserController implements the CRUD actions for Utilizador model.
 */
class TipologiaController extends ActiveController
{
    public $modelClass = 'common\models\Tipologia';

    public function actionTipologias(){
        $tipologiamodel = new $this->modelClass;
        $request = Yii::$app->request;
        if (!$request->isGet)
        {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método GET");
        }

        $tipologiaArray = $tipologiamodel::find()->asArray()->all();
        if($tipologiaArray) {
            return $tipologiaArray;
        }
        return ["tipologia" => "false", "erro" => "Erro ao carregar as tipologias. Tente mais tarde se persistir contacte a equipa."];
    }
}