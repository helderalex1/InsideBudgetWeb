<?php

namespace app\modules\api\controllers;

use common\models\FornecedorInstalador;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'auth_key',
        ];
        return $behaviors;
    }

    public function actionProdutos()
    {
        $Produtos = new $this->modelClass;
        $request = Yii::$app->request;
        if (!$request->isGet) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException('Erro de método você só tem permissões para fazer o método GET');
        }
        $produtosArray = $Produtos::find()->asArray()->all();

        if ($produtosArray) {
            return $produtosArray;
        }
        return ["produto" => "false", "erro" => "Erro ao carregar os produtos. Tente mais tarde se persistir contacte a equipa."];
    }
}

