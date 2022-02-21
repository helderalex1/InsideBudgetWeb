<?php

namespace app\modules\api\controllers;

use common\models\Dadospessoais;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use Yii;
use yii\db\Query;


class DadosPessoaisController extends ActiveController
{
    public $modelClass = 'common\models\Dadospessoais';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'auth_key',
        ];
        return $behaviors;
    }
    public function actionDados()
    {
        $DadosPessoais = new $this->modelClass;
        $request = Yii::$app->request;
        if (!$request->isGet) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método GET");
        }

        $dadospessoaisArray = $DadosPessoais::find()->select('id,nomecompleto, empresa,pais,cidade,morada, telefone, user_id')->asArray()->all();

        if ($dadospessoaisArray) {
            return $dadospessoaisArray;
        }
        return ["dadospessoais" => "false","erro" => "Erro ao carregar os dados pessoais. Tente mais tarde se persistir contacte a equipa"];
    }
}
