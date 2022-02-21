<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dadospessoais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dadospessoais-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <p>Email<br>
        <input readonly="readonly" value="<?= $user->email?>"></p>
    <p>Nome Completo<br>
        <input value="<?= $dados->nomecompleto?>"></p>
    <p>Empresa<br>
        <input value="<?= $dados->empresa?>"></p>
    <p>Morada<br>
        <input value="<?= $dados->morada?>"></p>
    <p>País<br>
        <input value="<?= $dados->pais?>"></p>
    <p>Cidade<br>
        <input value="<?= $dados->cidade?>"></p>
    <p>Telefone<br>
        <input  value="<?= $dados->telefone?>"></p>
    <div class="form-group">
        <?= Html::a('Atualizar dados', ['update','id'=>$dados->user_id],['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end();var_dump($dados->save()); var_dump($dados->geterrors());?>

</div>
