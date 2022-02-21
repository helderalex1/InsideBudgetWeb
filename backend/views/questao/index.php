<?php

use common\models\Assunto;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questões';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="contacto-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label' => 'Username',
                'attribute' => 'user_id',
                'value'=>function($data){
                    return \common\models\User::findOne(['id' => $data->user_id])->username;
                }
            ],
            [
                'attribute' => 'assunto_id',
                'value'=>function($data){
                    return Assunto::findOne(['id' => $data->assunto_id])->assunto;
                }
            ],
            //'assunto_id',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'mensagem',
            'email',
            [
                    'label' => 'Estado',
                    'format' => 'raw',
                //concluida
                    'value'=> function ($data){
                    if($data->concluida == 1){
                        return Html::a('Questão por resolver', ['/questao/concluida', 'id' => $data->id], ['class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Tem a certeza que quer concluiar a questão?',
                                'method' => 'post',],
                            ]);
                    }else{
                        return Html::a('Questão resolvida', ['/questao/concluida', 'id' => $data->id], ['class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Tem a certeza que quer reabrir a questão?',
                                'method' => 'post',
                            ],]);
                    }  }
            ],
            //'respondida',
            [
                'label' => 'Resposta',
                //concluida
                'value'=> function ($data){
                    if($data->respondida == 0){
                        return 'Por responder';
                    }else{
                        return 'À espera de resposta';
                    }  }
            ],
            'data',
            //'utilizador_id',

            //'updated_at',
            //'verification_token',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>
