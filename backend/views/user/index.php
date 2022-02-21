<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores com acesso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1>Lista de utilizadores com acesso</h1>

        <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'post']); ?>
        Procurar por username:
        <input type="text" name="nome">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            'created_at',
            'status',
            [
                'label'=> 'status',
                'format' => 'raw',
                'value'=>function($data){
                    if($data->status == 0){
                        return Html::a('Desbloquear', ['statusindex', 'id'=>$data->id], ['class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Tem a certeza que deseja desbloquear o utilizador '.$data->username.'?',
                                'method' => 'post',
                            ],]);
                    }else{
                        return Html::a('Bloquear', ['statusindex', 'id'=>$data->id], ['class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Tem a certeza que deseja bloquear o utilizador '.$data->username.'?',
                                'method' => 'post',
                            ],]);
                    }}

            ],
            //'updated_at',
            //'verification_token',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>
