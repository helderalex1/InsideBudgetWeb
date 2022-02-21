<?php

namespace app\modules\api\controllers;

use common\models\AuthAssignment;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use function Sodium\add;


class OrcamentoProdutoController extends ActiveController
{
    public $modelClass = 'common\models\OrcamentoProduto';
    public $modelOrcamento = 'common\models\Orcamento';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'auth_key',
        ];
        return $behaviors;
    }
    public function actionOrcamentosprodutos($user_id)
    {
        $request = Yii::$app->request;
        if (!$request->isGet) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método GET");
        }
        $produtosorcamentosmodel = new $this->modelClass;
        $ModelOrcamento = new $this->modelOrcamento();
        $funcao = AuthAssignment::findOne(['user_id' => $user_id])->item_name;
        if($funcao == 'fornecedor'){
            return $produtosorcamentosmodel::find()->asArray()->all();
        }
        $Orcamento = $ModelOrcamento::find()->where(["user_id" => $user_id])->all();
        $lista[0]=null;
        $i=0;
        $orcamentoProdutos = $produtosorcamentosmodel::find()->all();
        foreach ($Orcamento as $orcamentos){
            foreach ($orcamentoProdutos as $orcamentoProduto){
                if($orcamentoProduto['orcamento_id']==$orcamentos['id']){
                    $lista[$i] =$orcamentoProduto;
                  $i++;}}}
        if($lista[0] != null) {
            return $lista;}
        return ["orcamentoproduto" => "false", "erro" => "Erro ao carregar os orcamento produtos. Tente mais tarde se persistir contacte a equipa."];
    }
}
