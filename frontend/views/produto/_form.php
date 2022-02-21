<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(['id' => 'produto-form']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => 300]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'tipologia_id')->dropDownList(ArrayHelper::map(\common\models\Tipologia::find()->asArray()->all(), 'id', 'nome'))->label('Tipo de produto') ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','name' => 'produto-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
