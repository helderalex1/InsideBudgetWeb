<?php

use common\models\Orcamento;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cliente */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cliente-view">

    <h1>Nome do cliente: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Orcamento', ['orcamento/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que deseja eliminar este cliente?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome',
            'empresa',
            'morada',
            'nif',
            'telefone',
            'email:email',
            //'user_id',
        ],
    ]) ?>
    <h2 align="center">Lista de orcamentos:</h2>
    <?php /*$orcamentos = \common\models\Orcamento::find()->where(['cliente_id'=> $model->id])->asArray()->all();
    foreach ($orcamentos as $orcamento) {?>
   <p> <?= Html::a($orcamento['nome'], ['orcamento/view', 'id' => $orcamento['id']], ['class' => 'btn btn-primary']) ?></p>
    <?php } */?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'descricao',
            'total',
            //'data',
            //'cliente_id',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orcamento $model, $key, $index, $column) {
                    return Url::toRoute(['orcamento/'.$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
