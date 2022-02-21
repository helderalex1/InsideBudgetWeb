<?php

use common\models\Orcamento;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orçamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orcamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
        <?php $id=2;$form = ActiveForm::begin(['action' => ['index'], 'method' => 'post']); ?>
        Procurar pelo nome do orçamento:
        <input type="text" name="nome">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>

</div>
<div class="form-group">
</div>

<?php ActiveForm::end(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'descricao',
            'total'=>[
                'attribute'=>'total',
                'value'=>function($data){
                    return $data->total.'€';
                }
            ],
            //'data',
            //'cliente_id',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orcamento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
