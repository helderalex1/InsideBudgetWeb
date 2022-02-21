<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DadosPessoais */

$this->title = 'Os meus Dados Pessoais ';
$this->params['breadcrumbs'][] = 'Dados';
?>
<div class="dados-pessoais-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Email<br>
        <input class="form-control" readonly="readonly" value="<?= \common\models\User::findOne(['id'=>Yii::$app->user->identity->getId()])->email?>"></p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
