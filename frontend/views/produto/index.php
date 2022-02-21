<?php

use common\models\Produto;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Todos os Produtos';
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
        <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'post']); ?>     Procurar por nome de produto:
        <input type="text" name="nome">
    <?php  echo Html::dropDownList('listaprodutos', 'nome',\yii\helpers\ArrayHelper::map(\common\models\Tipologia::find()->all(),'id','nome'),
        ['prompt'=>'Selecionar o tipo']); ?>

    <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>


<?php ActiveForm::end(); ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'referencia',
            'descricao',
            'preco'=>[
                'attribute'=>'preco',
                'value'=>function($data){
                    return $data->preco.'€';
                }
            ],
            [
                    'label'=>'Tipologia',
                    'value' => function($data){
                        return \common\models\Tipologia::findOne(['id'=>$data->tipologia_id])->nome   ;
                    }
            ],
            [
                'label'=>'Nome do Fornecedor',
                'value' => function($data){
                    return \common\models\Dadospessoais::findOne(['user_id' =>\common\models\User::findOne(['id'=>$data->fornecedor_id])->id])->nomecompleto;
                }
            ],
            //'fornecedor_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>
