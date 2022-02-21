<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = 'Produto ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?php if($model->fornecedor_id == Yii::$app->user->identity->getId()){?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome',
            'referencia',
            'preco',
            //'fornecedor_id',
            [
                    'label' => 'Fornecedor',
                    'value' => function ($data){
                            return \common\models\Dadospessoais::findOne(['user_id' => User::findOne(['id' => $data->fornecedor_id])])->nomecompleto;
                    }
            ],
        'descricao'
        ],
    ]) ?>

</div>
