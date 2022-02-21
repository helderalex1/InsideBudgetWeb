<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model LoginForm */

use common\models\LoginForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    Se esqueceu-se da sua password <?= Html::a('Reinicia', ['site/request-password-reset']) ?>.
                    <br>
                    Precisa de uma nova verificação de email? <?= Html::a('Reenvia', ['site/resend-verification-email']) ?>
                </div>



                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-4" style="padding-top: 2% ">
            <img src="<?php if(Yii::$app->getHomeUrl() != "/"){echo Yii::$app->getHomeUrl();}?>/img/logoprojeto1.png"/>
        </div>
    </div>
</div>
