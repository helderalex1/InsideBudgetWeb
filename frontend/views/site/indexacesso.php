<?php

/* @var $this yii\web\View */


use common\models\Cliente;
use common\models\Orcamento;

?>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 5%;
        }

        td, th {
            border: 1px solid #dddddd;
            padding: 8px;
        }
    </style>
    <div>
<?php
if(!Yii::$app->user->isGuest){
    $funcao =  \common\models\AuthAssignment::findOne(['user_id'=>Yii::$app->user->identity->getId()])->item_name;
    if($funcao == "instalador"){
        $this->title = 'Informações Instalador';
        $orcamentosProdutos = \common\models\Orcamentoproduto::find()->asArray()->all();
        $produtos =\common\models\Produto::find()->asArray()->all();
        $orcamentos = \common\models\Orcamento::find()->where(['user_id' =>Yii::$app->user->identity->getId()])->asArray()->all();
        $clientes = \common\models\Cliente::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->asArray()->all();
        $produtoid=0;
        $quantpro1 = 0;
        $quantpro2 = 0;
        $lista[0]=null;
        $i=0;
        foreach ($orcamentos as $orcamento){
            foreach ($orcamentosProdutos as $orcamentoProduto){
                if($orcamentoProduto['orcamento_id']==$orcamento['id']){
                    $lista[$i] =$orcamentoProduto;
                    $i++;
                }
            }
        }
        if($produtos != null && $lista[0] !=null) {
            foreach ($produtos as $produto) {
                $quantpro1 = 0;
                foreach ($lista as $instOrcamentoProduto) {
                    //var_dump($produto["id"]);
                    if ($produto["id"] == $instOrcamentoProduto["produto_id"]) {
                        $quantpro1 = $quantpro1 + $instOrcamentoProduto["quantidade"];
                        if ($quantpro1 >= $quantpro2) {
                            $produtoid = $produto["id"];
                            $quantpro2 = $quantpro1;
                        }
                    }
                }
            }
        }

        $lista[0]=null;
        $i=0;
        foreach ($orcamentos as $orcamento){
            foreach ($orcamentosProdutos as $orcamentoProduto){
                if($orcamentoProduto['orcamento_id']==$orcamento['id']){
                    $lista[$i] =$orcamentoProduto;
                    $i++;
                }
            }
        }
        $totalquantidadeprodutos = 0;
        foreach ($orcamentosProdutos as $orcamentosProduto){
            $totalquantidadeprodutos = $totalquantidadeprodutos + $orcamentosProduto['quantidade'];
        }
        ?>

        <table style="text-align: center">
            <tr>
                <th style="text-align: center"><p>Total clientes<?= count(Cliente::findAll(['user_id'=>Yii::$app->user->identity->getId()]))?> </p></th>
            </tr>
            <tr>
                <th style="text-align: center"><p>Total orcamentos<?= count(Orcamento::findAll(['user_id'=>Yii::$app->user->identity->getId()]))?> </p></th>
            </tr>
            <tr>
                <th style="text-align: center">Total de produtos <?php if($lista[0] != null){echo count($lista);} else{echo 0;}?></th>
            </tr>
            <tr>
                <th style="text-align: center">Quantidade de produtos <?= $totalquantidadeprodutos?></th>
            </tr>
            <tr>
                <th style="text-align: center"><p>Produto com mais quantidades <?php if($produtoid!=null){ echo \common\models\Produto::findOne(["id"=>$produtoid])->nome . " com ".$quantpro2 . " quantidades.";}else{echo "Nenhum";}?></p>
                </th>
            </tr>
        </table>
    <?php }else if($funcao == "fornecedor"){
        $this->title = 'Informações Fornecedor';
        $orcamentosProdutos = \common\models\Orcamentoproduto::find()->asArray()->all();
        $produtos =\common\models\Produto::find()->where(["fornecedor_id"=>Yii::$app->user->identity->getId()])->asArray()->all();
        $orcamentos = \common\models\Orcamento::find()->asArray()->all();
        $clientes = \common\models\Cliente::find()->asArray()->all();
        $produtoid=0;
        $quantpro1 = 0;
        $quantpro2 = 0;
        $countUser1 = 0;
        foreach ($produtos as $produto){
            $quantpro1=0;
            foreach ($orcamentosProdutos as $orcamentoProduto) {
                //var_dump($produto["id"]);
                if($produto["id"] ==$orcamentoProduto["produto_id"]){
                    $quantpro1 = $quantpro1 + $orcamentoProduto["quantidade"];
                    if($quantpro1 >= $quantpro2) {
                        $produtoid = $produto["id"];
                        $quantpro2 = $quantpro1;
                    }
                }
            }
            $quantpro1 = 0;
        };
        $orcamentoFornecedor = 0;
        $flagOrcamento = 0;
        foreach ($orcamentos as $orcamento){
            $flagOrcamento = 1;
            foreach ($orcamentosProdutos as $orcamentoProduto){
                if($orcamento["id"] == $orcamentoProduto["orcamento_id"]){
                    foreach ($produtos as $produto) {
                        if($flagOrcamento ==1){
                            if ($orcamentoProduto["produto_id"] == $produto["id"]) {
                                // $flagOrcamento = 1;
                                $orcamentoFornecedor++;
                                $flagOrcamento = 0;
                            }
                        }
                    }
                }
            }
        }
        $valor = null;
        $flagCliente = null;
        $clienteFornecedor = 0;
        foreach ($clientes as $cliente) {
            $flagCliente = 1;
            foreach ($orcamentos as $orcamento) {
                if ($cliente["id"] == $orcamento["cliente_id"]) {
                    foreach ($orcamentosProdutos as $orcamentoProduto) {
                        if ($orcamento["id"] == $orcamentoProduto["orcamento_id"] && $valor != $orcamento["id"]) {
                            $valor = $orcamento["id"];
                            foreach ($produtos as $produto) {
                                if ($orcamentoProduto["produto_id"] == $produto["id"]) {
                                    if($flagCliente == 1) {
                                        $clienteFornecedor++;
                                        $flagCliente =0;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        ?>
        <table>
            <tr>
                <th style="text-align: center">
                    <div class="col-lg-12">
                        <p>Total dos meus Produtos <?= count(\common\models\Produto::findAll(["fornecedor_id"=> Yii::$app->user->identity->getId()]))?> </p>
                    </div>
                </th>
                </tr>
            <tr>
                <th style="text-align: center">
                    <p>Total de Clientes: <?= $clienteFornecedor?></p>
                </th>
            </tr>
            <tr >
                <th style="text-align: center">
                    <p>Total de Orçamentos <?= $orcamentoFornecedor?></p>
                </th>
            </tr>
            <tr>
                <th style="text-align: center">
                        <p>Meu produto mais utilizado <?php if($produtoid!=null){ echo \common\models\Produto::findOne(["id"=>$produtoid])->nome . " com ".$quantpro2 . " quantidades.";}else{echo "Nenhum";}?></p>
                </th>
            </tr>
        </table>
    <?php }?>

    </div>
<?php }?>