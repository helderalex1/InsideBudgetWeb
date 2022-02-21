<?php

namespace app\modules\api\controllers;


use common\models\AuthAssignment;
use common\models\Cliente;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends ActiveController
{

    public $modelClass = 'common\models\Cliente';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'auth_key',
        ];
        return $behaviors;
    }

    public function actionClientes($user_id)
    {
        $request = Yii::$app->request;
        if (!$request->isGet) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método GET");
        }

        $cliente = new $this->modelClass;
        $funcao = AuthAssignment::findOne(['user_id' => $user_id])->item_name;
        if($funcao == 'fornecedor'){
            return $cliente::find()->asArray()->all();
        }
        $clientesArray = $cliente::find()->where(['user_id'=>$user_id])->asArray()->all();

        if ($clientesArray) {
            return $clientesArray;
        } else {
            return ["cliente" => "false", "erro" => "Erro ao carregar os clientes. Tente mais tarde se persistir contacte a equipa"];
        }
    }

    public function actionAddcliente()
    {
        $cliente = new $this->modelClass;
        $request = Yii::$app->request;
        if (!$request->isPost) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Error method you only have permissions to do get method");
        }
        $id = $request->getBodyParam("id");
        $existeCliente = $this->findModel($id);
        $nome = $request->getBodyParam("nome");
        $empresa = $request->getBodyParam("empresa");
        $morada = $request->getBodyParam("morada");
        $nif = $request->getBodyParam("nif");
        $telefone = $request->getBodyParam("telefone");
        $email = $request->getBodyParam("email");
        $user_id = $request->getBodyParam("user_id");
        if($existeCliente){
            $existeCliente->nome = $nome;
            $existeCliente->empresa = $empresa;
            $existeCliente->morada = $morada;
            $existeCliente->nif = $nif;
            $existeCliente->telefone = $telefone;
            $existeCliente->email = $email;
            $existeCliente->user_id = $user_id;
            $existeCliente->load($this->request->post());
            return $existeCliente->save();

        }else{
            $cliente->nome = $nome;
            $cliente->empresa = $empresa;
            $cliente->morada = $morada;
            $cliente->nif = $nif;
            $cliente->telefone = $telefone;
            $cliente->email = $email;
            $cliente->user_id = $user_id;
            $cliente->load($this->request->post());
            return $cliente->save();
        }
    }
    private function findModel($id)
    {
        if (($model = Cliente::findOne(['id' => $id])) !== null) {
            return $model;
        }
        return false;
    }
}
