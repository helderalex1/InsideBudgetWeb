<?php

namespace backend\controllers;

use common\models\AuthAssignment;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUtilizadores()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if (User::findOne(['username' => $model->username]) != null) {
                $user = User::findOne(['username' => $model->username]);
                $verificar_password = Yii::$app->getSecurity()->validatePassword($model->password, $user->password_hash);
                if ($user->status == 10 && $verificar_password) {
                    $funcao = AuthAssignment::findOne(['user_id' => User::findByUsername($model->username)->getId()])->item_name;

                    if ($funcao == 'admin' && $model->validate() && $model->login()) {
                        return $this->goBack();
                    }
                    $model->addError('password', 'Voc?? n??o t??m acesso');
                } elseif ($user->status == 9 && $verificar_password) {
                    $model->addError('password', '?? espera da aprova????o da administra????o');
                } elseif ($user->status == 8 && $verificar_password) {
                    $model->addError('password', '?? necess??rio confirmar o email para entrar na lista de aprova????o.');
                } elseif ($user->status == 0 && $verificar_password) {
                    $model->addError('password', 'Voc?? est?? bloqueado, para mais informa????es contacte a administra????o.');
                } else {
                    $model->addError('password', 'Username ou password incorreta');
                }
            }
        }
        $model->addError('password', 'Username ou password incorreta');


        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
