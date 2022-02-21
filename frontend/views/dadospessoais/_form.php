<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DadosPessoais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dados-pessoais-form">

    <?php $form = ActiveForm::begin(['id' => 'dados-form']); ?>

    <?= $form->field($model, 'nomecompleto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Atualizar dados', ['class' => 'btn btn-success', 'name' => 'dados-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
