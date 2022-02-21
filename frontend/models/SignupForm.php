<?php

namespace frontend\models;

use common\models\Dadospessoais;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmarPassword;
    public $nomecompleto;
    public $empresa;
    public $morada;
    public $pais;
    public $cidade;
    public $telefone;
    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Já foi utilizado esse username'],
            ['username', 'string', 'min' => 5, 'max' => 50],

            ['email', 'trim'],
            ['email', 'email','message'=>"Email inválido para endereço de email"],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Já foi utilizado esse email'],

            //['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password', 'string', 'min' => 6, 'max' => 50],
            ['confirmarPassword', 'string', 'min' => 6, 'max' => 50],
            [['confirmarPassword'],'compare','compareAttribute'=>'password','message'=>'O campo Confirmar Password têm que ser igual ao campo Password'],
            [['username','password','confirmarPassword','email','nomecompleto','pais','empresa', 'cidade', 'morada', 'telefone'],'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['role'],'required','message'=>"Funcão inválida"],
            ['telefone', 'integer']

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $dados = new Dadospessoais();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
        if($user->save()){
            $dados->nomecompleto = $this->nomecompleto;
            $dados->empresa = $this->empresa;
            $dados->pais = $this->pais;
            $dados->cidade = $this->cidade;
            $dados->morada = $this->morada;
            $dados->telefone = $this->telefone;
            $dados->user_id = $user->id;
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole($this->role);
            $auth->assign($authorRole, $user->getId());
            return $dados->save() && $this->sendEmail($user);
        }else{
             return null;
        }
        //return $user->save() && $this->sendEmail($user);
    }
    public function attributeLabels()
    {
        return [
            'role' => 'Função',
            'nomecompleto' => "Nome Completo",
        ];
    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Conta registada no ' . Yii::$app->name)
            ->send();
    }
}
