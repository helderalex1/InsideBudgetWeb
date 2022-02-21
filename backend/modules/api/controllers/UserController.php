<?php

namespace app\modules\api\controllers;

use common\models\AuthAssignment;
use common\models\Dadospessoais;
use common\models\User;
use frontend\models\SignupForm;
use Yii;
use yii\rest\ActiveController;


/**
 * UserController implements the CRUD actions for Utilizador model.
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $modelFuncao = 'common\models\AuthAssignment';
    public $modelDadosPessoais = 'common\models\DadosPessoais';
    public $modelSignup = 'frontend\models\SignupForm';
    public function actionLogin(){
        $usermodel = new $this->modelClass;
        $funcaomodel = new $this->modelFuncao;
        $dadospessoaismodel = new $this->modelDadosPessoais;
        $request = Yii::$app->request;
        if (!$request->isPost)
        {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException("Erro de método você só tem permissões para fazer o método POST");
        }
        $username = $request->getBodyParam("username");
        $password = $request->getBodyParam("password");
        $user = $usermodel::find()->where(["username"=>$username])->one();
        if(!$user){
            return ["login"=>"false","texto"=>"Username ou password invalida"];
        }else if($user->status == 0 ){
            return ["login"=>"false","texto"=>"Conta bloqueado, para mais informações contactar a equipa."];
        }else if($user->status == 9  ){
            return ["login"=>"false","texto"=>"A conta encontra-se em lista de espera para aprovação, para mais informações contactar a equipa."];
        }else if($user->status == 10  ){
            $hash = $user->password_hash;
            if(Yii::$app->getSecurity()->validatePassword($password, $hash) == true){
                $dados = $dadospessoaismodel::findOne(["user_id"=>$user->id]);
                return ["login"=>"true","id"=>$user->id,"username"=>$user->username,"email"=>$user->email, "nome"=>$dados->nomecompleto,
                    "empresa" => $dados->empresa, "morada"=> $dados->morada, "pais"=>$dados->pais,"cidade"=> $dados->cidade, "telefone"=>$dados->telefone,
                    "funcao"=>$funcaomodel::findOne(["user_id"=>$user->id])->item_name, "auth_key" => $user->auth_key];
            }else{
                return ["login"=>"false","texto"=>"Username ou password invalida"];
            }
        }
        return ["login"=>"false","texto"=>"Erro ao fazer o login. Tente mais tarde se persistir contacte a equipa."];
    }
    public function actionRegistar()
    {
        $user = new $this->modelClass;
        $funcao = new $this->modelFuncao;
        $dados = new $this->modelDadosPessoais;
        $signup = new $this->modelSignup;
        $request = Yii::$app->request;
        if (!$request->isPost) {
            Yii::$app->response->statusCode = 400;
            throw new \yii\web\BadRequestHttpException('Erro de método você só tem permissões para fazer o método POST');
        }
        $username = $request->getBodyParam("username");
        $email = $request->getBodyParam("email");
        $password = $request->getBodyParam("password");
        $nomecompleto = $request->getBodyParam("nomecompleto");
        $empresa = $request->getBodyParam("empresa");
        $pais = $request->getBodyParam("pais");
        $cidade = $request->getBodyParam("cidade");
        $morada = $request->getBodyParam("morada");
        $telefone = $request->getBodyParam("telefone");
        $role = $request->getBodyParam("funcao");
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
       // return $user->save();
        if(User::findOne(['username'=> $username])){
            return ["registar"=>"false","texto"=>"Erro ao registar, já existe esse username"];
        }
        if(User::findOne(['email'=> $email])){
            return ["registar"=>"false","texto"=>"Erro ao registar, já existe esse email"];
        }
        if ($user->save()) {
            $dados->nomecompleto = $nomecompleto;
            $dados->empresa = $empresa;
            $dados->pais = $pais;
            $dados->cidade = $cidade;
            $dados->morada = $morada;
            $dados->telefone = $telefone;
            $dados->user_id = $user->id;
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole($role);
            $auth->assign($authorRole, $user->getId());
            if($dados->save()){
                $this->sendEmail($user);
                return ["registar"=>"true","texto"=>"Registo concluido com sucesso"];
            }else{
                $user->delete();
                $dados->geterrors();
                return ["registar"=>"false","texto"=>"Erro no registo"];
            }
        } else {
            return ["registar"=>"false","texto"=>"Erro no registo"];
        }
        }
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject('AAconta registada no ' . Yii::$app->name)
            ->send();
    }
}