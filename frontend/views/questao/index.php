<?php

use common\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;use yii\httpclient\Client;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Assunto;
use \common\models\Questao;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Questões';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacto-index">

    <h1>Minhas <?= Html::encode($this->title)?></h1>


    <p>
        <?= Html::a('Criar Questão', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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
                        return 'Questão por resolver';
                    }else{
                        return 'Questão resolvida';
                    }  }
            ],
            //'respondida',
            [
                'label' => 'Resposta',
                //concluida
                'value'=> function ($data){
                    if($data->respondida == 1){
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
