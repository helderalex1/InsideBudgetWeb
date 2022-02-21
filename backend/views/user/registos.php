<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores à espera de acesso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1>Lista de registos em espera de aprovação</h1>
    <?php $form = ActiveForm::begin(['action' => ['registos'], 'method' => 'post']); ?>
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
            'email:email',
            'created_at',
            'status',
            [
                'label'=> 'Permitir',
                'format' => 'raw',
                'value'=>function($data){
                        return Html::a('Permitir', ['statusregistospermitir', 'id'=>$data->id], ['class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Tem a certeza que deseja permitir o utilizador '.$data->username.'?',
                                'method' => 'post',
                            ],]);
                }
            ],
            [
                'label'=> 'Bloquear',
                'format' => 'raw',
                'value'=>function($data){
                    return Html::a('Proibir/Recusar', ['statusregistosproibir', 'id'=>$data->id], ['class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Tem a certeza que deseja proibir/recusar o utilizador '.$data->username.'?',
                            'method' => 'post',
                        ],]);
                }
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
