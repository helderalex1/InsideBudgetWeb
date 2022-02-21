<?php
use yii\helpers\Html;
use yii\grid\GridView;

include 'C:\wamp64\www\projeto\frontend\web\phpqrcode\qrlib.php';
$this->title="pdf view";
$this->params["breadcumbs"][] =$this->title;
?>
<style>
    .tabela {
        width: 100%;
        border-collapse: collapse;
    }
    .tabela td, .tabela th{
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
</style>

<?php
$dir = 'temp/';
if(!file_exists($dir)){

    mkdir($dir);
}
$filename = $dir."test.jpg";
$tamanho= 5;
$level = 'M';
$margin = 0;
$conteudo = $orcamento->uid;
QRcode::png($conteudo,$filename,$level, $tamanho,$margin) ; ?>


<div style="right: 10px;position: absolute;  ">
    <?php echo '<img src="'.$filename.'"/>'?></div>
<div class="container">
    <table>
        <tr>
            <th style="font-size: 30px; text-align: left "><?= $dados->empresa ?></th>
        </tr>
        <tr>
            <th style="font-size: 20px; text-align: left "><?= $dados->morada ?></th>
        </tr>
        <tr>
            <th style="font-size: 20px; text-align: left "><?= $user->email ?>/<?= $dados->telefone ?></th>
        </tr>
    </table>
</div>
<h1 style="text-align:center ">Orcamento</h1>
<div class="container">
    <table>
        <tr>
            <th style="text-align: left; font-size: 15px;">Cliente: <?= $cliente->nome ?></th>
        </tr>
        <tr>
            <th style="text-align: left; font-size: 15px;">Empresa: <?= $cliente->empresa ?></th>
        </tr>
        <tr>
            <th style="text-align: left; font-size: 15px;">Morada: <?= $cliente->morada ?></th>
        </tr>
        <tr>
            <th style="text-align: left; font-size: 15px;">NIF: <?= $cliente->nif ?></th>
        </tr>
        <tr>
            <th style="text-align: left; font-size: 15px;">Telefone: <?= $cliente->telefone ?></th>
        </tr>
        <tr>
            <th style="text-align: right; font-size: 15px;">Email: <?= $cliente->email ?></th>
        </tr>
    </table>
</div>
<div class="container" style="margin-top: 50px">


    <table class="tabela">

        <tr style="background-color: #95999c;">
            <th>Nome</th>
            <th>Referência</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Preço Total</th>
        </tr>
        <?php
        for ($i = 1; $i <= 1; $i++) {
            foreach ($orcamentoProdutos as $orcamentoProduto){?>
        <tr>
            <th><?= \common\models\Produto::findOne(["id"=>$orcamentoProduto->produto_id])->nome?></th>
            <th><?= \common\models\Produto::findOne(["id"=>$orcamentoProduto->produto_id])->referencia?></th>
            <th><?= $orcamentoProduto->quantidade?></th>
            <th><?= \common\models\Produto::findOne(["id"=>$orcamentoProduto->produto_id])->preco?>€</th>
            <th><?= \common\models\Produto::findOne(["id"=>$orcamentoProduto->produto_id])->preco * $orcamentoProduto->quantidade?>€</th>
        </tr>
        <?php }}?>
        <tr>
            <th colspan="4" style="text-align: right">Total do orcamento:</th>
            <th><?= $orcamento->total ?>€</th>
        </tr>
    </table>
</div>

