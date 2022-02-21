<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Resposta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resposta-form">

    <?php $form = ActiveForm::begin(['id' => 'resposta-form']); ?>

    <?= $form->field($model, 'questao_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'texto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Responder', ['class' => 'btn btn-success', 'name' => 'responder-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
