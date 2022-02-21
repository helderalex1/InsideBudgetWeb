<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Assunto;

/* @var $this yii\web\View */
/* @var $model common\models\Questao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacto-form">

    <?php $form = ActiveForm::begin(['id' => 'questao-form']); ?>

    <?= $form->field($model, 'assunto_id')->dropDownList(ArrayHelper::map(Assunto::find()->asArray()->all(), 'id', 'assunto')) ?>

    <?= $form->field($model, 'mensagem')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Criar questão', ['class' => 'btn btn-success', 'name' => 'questao-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
