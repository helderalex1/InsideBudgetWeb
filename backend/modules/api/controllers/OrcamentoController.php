<?php

namespace app\modules\api\controllers;

use common\models\AuthAssignment;
use common\models\Orcamento;
use common\models\User;
use Yii;
use yii\db\Query;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


/**
 * OrcamentoController implements the CRUD actions for Orcamento model.
 */
class OrcamentoController extends ActiveController
{
    public $modelClass = 'common\models\orcamento';
    public $modelCliente = 'common\models\cliente';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'auth_key',
        ];
        return $behaviors;
    }

    public function actionOrcamentos($user_id)
    {
        $ModelCliente = new $this->modelCliente();
        $ModelOrcamento = new $this->modelClass();
        $request = Yii::$app->request;
        if (!$request->isGet) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método GET");
        }
        $funcao = AuthAssignment::findOne(['user_id' => $user_id])->item_name;
        if($funcao == 'fornecedor'){
            return $ModelOrcamento::find()->asArray()->all();
        }
        $Orcamento = $ModelOrcamento::find()->where(["user_id" => $user_id])->all();
        if($Orcamento) {
            return $Orcamento;
        }
        return ["orcamento" => "false", "erro" => "Erro ao carregar os orcamentos. Tente mais tarde se persistir contacte a equipa."];
    }

    public function actionAddorcamento(){
        $orcamento = new $this->modelClass();
        $request = Yii::$app->request;
        if (!$request->isPost) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método POST");
        }
        $model = new $this->modelClass();
        $id = $request->getBodyParam("id");
        $nome = $request->getBodyParam("nome");
        $user_id = $request->getBodyParam("user_id");
        $cliente_id = $request->getBodyParam("cliente_id");
        $descricao = $request->getBodyParam("descricao");
        $existeOrcamento = $this->findModel($id);
        if($existeOrcamento){
            $existeOrcamento->nome = $nome;;
            $existeOrcamento->descricao = $descricao;
            $existeOrcamento->load($this->request->post());
            $existeOrcamento->uid = Yii::$app->security->generateRandomString(12);
            $existeOrcamento->save();
            return $existeOrcamento->getErrors();
        }else{
            $model->nome = $nome;
            $model->user_id = $user_id;
            $model->cliente_id = $cliente_id;
            $model->data = date("Y-m-d h:i:s");
            $model->descricao = $descricao;
            $model->uid = Yii::$app->security->generateRandomString(12);
            $model->load($this->request->post());
            return $model->save();

        }
    }
    private function findModel($id)
    {
        if (($model = Orcamento::findOne(['id' => $id])) !== null) {
            return $model;
        }
        return false;
    }
}
