<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Dropdown;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */

$this->title = 'Orçamento: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Cliente: '.\common\models\Cliente::findOne(['id'=>$model->cliente_id])->nome, 'url' => ['cliente/view','id'=> $model->cliente_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orcamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar PDF', ['pdf', 'id'=>$model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome',
            'total',
            'data',
            //'cliente_id',
            //'user_id',
            'descricao'
        ],
    ]) ?>
    <h2 align="center">Lista de todos os Produtos</h2>

    <div class="col-md-auto">
        <?php $id=2;$form = ActiveForm::begin(['action' => ['view','id'=>$model->id], 'method' => 'post']); ?>
        <?php  echo Html::dropDownList('listaprodutos', 'nome',\yii\helpers\ArrayHelper::map(\common\models\Tipologia::find()->all(),
        'id','nome'),array('options' => array($selecionada=>array('selected'=>true))));?>
        Procurar por nome de produto:
        <input type="text" name="nome">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
    </div>

    <?php ActiveForm::end(); ?>

    <div class="col-md-auto overflow-auto"  style="height: 30vh">
        <table class="table text-center p-0">

            <?php  if($produtos!=null){?>
                <tr style="background-color: #9fcdff">
                    <td>Nome</td>
                    <td>Referência</td>
                    <td>Tipologia</td>
                    <td>Preço</td>
                    <td>Descrição</td>
                    <td>Quantidade</td>
                    <td>Adicionar</a></td>
                </tr>
                <?php foreach ($produtos as $produto){ ?>
                    <tr>
                        <?php $form = ActiveForm::begin(['action' => ['addproduto' , 'id' => $model->id], 'method' => 'post']); ?>
                        <?=$form->field($orcamento_produto, 'orcamento_id')->hiddenInput(['value'=>''.$model->id.''])->label(false); ?>
                        <?=$form->field($orcamento_produto, 'produto_id')->hiddenInput(['value'=>''.$produto['id'].''])->label(false); ?>
                        <td><?=$produto['nome'] ?></td>
                        <td><?=$produto['referencia'] ?></td>
                        <td><?=\common\models\Tipologia::findOne([$produto['tipologia_id']])->nome ?></td>
                        <td><?=$produto['preco'].'€' ?></td>
                        <td><?=Html::a('Visualizar produto', ['produto/view', 'id' =>$produto['id'],], ['class' => 'btn btn-secondary'])?></td>
                        <td><?= $form->field($orcamento_produto, 'quantidade',['options' => ['class' => 'form-group']] )->input('number', ['value' => 1,'min' => 0, 'max' => 100, 'step' => 1])->label(false);?></td>
                        <td><?= Html::submitButton('+', ['class' => 'btn btn-success']) ?></a></td>
                        <?php ActiveForm::end(); ?>
                    </tr>
                <?php }
            }else { ?>
                <h2 align="center" style="color: red">Produto(s) não encontrado(s)</h2>
            <?php ;}?>
        </table>
    </div>
</div>
<h2 align="center">Lista de Produtos no Orçamento</h2>
<div class="row mb-5">
    <div class="col-md-12">
        <table class="table table-striped text-center p-0">
            <thead>
            <tr style="background-color: #9fcdff">
                <td>Nome</td>
                <td>Referencia</td>
                <td>Quantidade</td>
                <td>Preço Unitário</td>
                <td>Preço Total</td>
                <td>Opções</td>
            </tr>
            </thead>
            <?php  if($model->getProdutosQuantidade()!=null ){?>
                <?php foreach ($model->getProdutosQuantidade() as $produto){ ?>
                    <tr>
                        <?php $form = ActiveForm::begin(['action' => 'updateproduto', 'method' => 'post']); ?>
                        <?=$form->field($orcamento_produto, 'orcamento_id')->hiddenInput(['value'=>''.$model->id.''])->label(false); ?>
                        <?=$form->field($orcamento_produto, 'produto_id')->hiddenInput(['value'=>''.$produto['id'].''])->label(false); ?>
                        <td><?=$produto['nome'] ?></td>
                        <td><?=$produto['referencia'] ?></td>
                        <td><?= $form->field($orcamento_produto, 'quantidade',['options' => ['class' => 'form-group']] )->input('number', ['value' => $produto['quantidade'],'min' => 0, 'max' => 100, 'step' => 1,'style'=>'margin-bottom: 0px;'])->label(false);?></td>
                        <td><?=$produto['preco'] .'€'  ?></td>
                        <td><?=$produto['preco'] *  $produto['quantidade'].'€'  ?></td>
                        <td>
                           <a> <?= Html::submitButton('Atualizar', ['class' => 'btn text-info']) ?></a>
                            <a class="btn text-danger" href="<?=Url::toRoute(['orcamento/deleteproduto', 'id' => $model->id, 'produto'=>$produto['id']]) ?>">X</a>
                        </td>
                        <?php ActiveForm::end(); ?>
                    </tr>
                <?php }} ?>
        </table>
    </div>
</div>
