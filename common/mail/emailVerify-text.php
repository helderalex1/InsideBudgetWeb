<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);

?>
<div class="verify-email">
    <p>Olá <?= Html::encode($user->username) ?>,</p>

    <p>Depois de verificar o email a sua conta ficará a aguardar pela a aprovação da administração.</p>
    <a href="<?=$verifyLink ?>">

    <p>Com os melhores cumprimentos<br>
    <p>Administração</p>

</div>