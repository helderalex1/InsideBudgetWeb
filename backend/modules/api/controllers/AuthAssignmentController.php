<?php

namespace app\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use Yii;
use yii\db\Query;


class AuthAssignmentController extends ActiveController
{
    public $modelClass = 'common\models\AuthAssignment';

     public function behaviors()
     {
         $behaviors = parent::behaviors();
         $behaviors['authenticator'] = [
             'class' => QueryParamAuth::className(),
             'tokenParam' => 'auth_key',
         ];
         return $behaviors;
     }

    public function actionFuncao($funcao)
    {
        $Auth = new $this->modelClass;
        $request = Yii::$app->request;
        if (!$request->isPost)
        {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método POST");
        }

        if($funcao == "admin"){
            $funcaoArray = $Auth::find()->select("item_name,user_id")->asArray()->all();
            if ($funcaoArray){
                return $funcaoArray;
            }
        }
        return ["funcao"=> "false", "erro"=>"Erro ao carregar as funções. Tente mais tarde se persistir contacte a equipa"];

    }
}
