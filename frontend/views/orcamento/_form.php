<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orcamento-form">

    <?php $form = ActiveForm::begin(['id' => 'orcamento-form']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'orcamento-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
