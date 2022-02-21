<?php

use common\models\Produto;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meus Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <?php
   $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->getId()) ;
   foreach ($roles as $role){
       $role1 = $role->name;
   }
   if($role1 == 'fornecedor'){ ?>
    <p>
        <?= Html::a('Criar Produto', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Meus Produtos', ['meusprodutos'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Todos os Produtos', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
<?php } ?>

        <?php $id=2;$form = ActiveForm::begin(['action' => ['meusprodutos'], 'method' => 'post']); ?>
        <?php  echo Html::dropDownList('listaprodutos', 'nome',\yii\helpers\ArrayHelper::map(\common\models\Tipologia::find()->all(),'id','nome'),
            ['prompt'=>'Selecionar o tipo']); ?>
        Procurar por nome de produto:
        <input type="text" name="nome">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

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
            'referencia',
            'preco',
            //'fornecedor_id',
            [
                    'label' => 'Tipologia',
                    'value' => function ($data){
        return \common\models\Tipologia::findOne(['id' => $data->tipologia_id])->nome;
                    }
],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
            ],
        ],
    ]); ?>


</div>
