<?php

use common\models\Cliente;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meus Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        <?php $id=2;$form = ActiveForm::begin(['action' => ['index'], 'method' => 'post']); ?>
        Procurar pelo nome do cliente:
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
            'empresa',
            'morada',
            'nif',
            'telefone',
            'email:email',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cliente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>
