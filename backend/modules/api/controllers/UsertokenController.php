<?php

namespace app\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use Yii;
use yii\db\Query;

class UsertokenController extends ActiveController
{
    public $modelClass = 'common\models\User';

     public function behaviors()
     {
         $behaviors = parent::behaviors();
         $behaviors['authenticator'] = [
             'class' => QueryParamAuth::className(),
             'tokenParam' => 'auth_key',
         ];
         return $behaviors;
     }

    public function actionUser()
    {
        $request = Yii::$app->request;
        if (!$request->isGet)
        {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método GET");
        }

        $User = new $this->modelClass;
        $List_User = $User::find()->select('id,username,email,status')->asArray()->all();

        if ($List_User){
            return $List_User;
        }
        return ["erro"=>"Sem Utilizadores no sistema"];
    }

    public function actionUserbanir($user_id, $banir)
    {
        $User = new $this->modelClass;
        $user1 = $User::find()->where(["id" => $user_id])->one();
        $request = Yii::$app->request;
        if (!$request->isPost)
        {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método POST");
        }

        if($banir == "true") {
            $user1->status = 0;
            $user1->save();
            return true;
        }else if ($banir == "false"){
            $user1->status = 10;
            $user1->save();
            return true;
        }

        return ["pedido"=>"false",'texto'=>"Erro ao banir ou desbanir. Tente mais tarde se persistir contacte a equipa."];
    }
}
