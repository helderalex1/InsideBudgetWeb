<?php

namespace frontend\controllers;

use common\models\AuthAssignment;
use common\models\Cliente;
use common\models\Dadospessoais;
use common\models\Orcamento;
use common\models\Orcamentoproduto;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Mpdf\Mpdf;
use Yii;
use yii\base\InvalidArgumentException;
use yii\debug\models\timeline\DataProvider;
use yii\rbac\Role;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionIndexacesso()
    {
        return $this->render('indexacesso');
    }
    public function actionDownloadapp()
    {
        return Yii::$app->response->sendFile("C:\wamp64\www\projeto\\frontend\web\img\\logoprojeto.png");
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
           // if ($model->validate()) {
                if (User::findOne(['username' => $model->username]) != null) {
                    $user = User::findOne(['username' => $model->username]);
                    $verificar_password = Yii::$app->getSecurity()->validatePassword($model->password,$user->password_hash);
                    if ($user->status == 10 && $verificar_password) {
                        $funcao = AuthAssignment::findOne(['user_id' => User::findByUsername($model->username)->getId()])->item_name;
                        if ($funcao == 'admin') {
                             $model->addError('password', 'Você não têm acesso');
                        }elseif ($model->validate() && $model->login()) {
                            return $this->redirect('indexacesso');
                        }
                    } elseif ($user->status== 9 && $verificar_password) {
                        $model->addError('password', 'Á espera da aprovação da administração');
                    } elseif ($user->status == 8 && $verificar_password) {
                        $model->addError('password', 'É necessário confirmar o email para entrar na lista de aprovação.');
                    } elseif ($user->status == 0 && $verificar_password)  {
                        $model->addError('password', 'Você está bloqueado, para mais informações contacte a administração.');
                    } else {
                        $model->addError('password', 'Username ou password incorreta');
                    }
                }
            $model->addError('password', 'Username ou password incorreta');
        }


        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Obrigado por nos contactar. Iremos responder o mais breve possível.');
            } else {
                Yii::$app->session->setFlash('error', 'Houve um erro ao enviar o contacto por favor tente outra vez.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Registo concluído, depois de confirmar o email terá que aguardar pela aprovação da administração.');
            return $this->goHome();
        }

        $role1= Yii::$app->authManager->getRoles();
        $i=0;
        foreach ($role1 as $roles2){
        if($roles2->name != 'admin') {
                $roles[$i] =  \Yii::$app->authManager->getRole($roles2->name);
            }
        $i++;
        }

        return $this->render('signup', [
            'model' => $model,
            'roles' => $roles,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique o seu email para mais instruções.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Pedimos desculpa mas não foi possível redefinir a palavra-passe para o endereço de e-mail fornecido.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nova password guardada.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'O seu email foi confirmado com sucesso!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Não foi possível verificar a conta com o token fornecido.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique o seu email para mais instruções.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Pedimos desculpa mas não foi possível reenviar a verificação de email para o endereço de e-mail fornecido.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
