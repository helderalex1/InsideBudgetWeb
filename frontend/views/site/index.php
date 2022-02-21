<?php
/* @var $this yii\web\View */
require'C:\wamp64\www\projeto\frontend\web\phpqrcode\qrlib.php';
$this->title = 'Inside Budget';
?>
<div class="site-index" >
    <?php
 /*   $dir = 'temp/';
    if(!file_exists($dir)){

        mkdir($dir);
    }
    $filename = Yii::$app->getHomeUrl().$dir."test.jpg";
    $tamanho= 5;
    $level = 'M';
    $margin = 0;
    $conteudo = Yii::$app->getHomeUrl().'projeto/frontend/web/site/downloadapp';
    QRcode::png($conteudo,$filename,$level, $tamanho,$margin) ;*/ ?>
    <div style="right: 10px;position: absolute;  ">
        <?php //echo '<img src="'.$filename.'"/>'?></div>
    <div class="jumbotron text-center bg-transparent" style="padding-bottom: 10px ">
        <h1 class="display-4"><img style="width: 50%;" src="<?php if(Yii::$app->getHomeUrl() != "/"){echo Yii::$app->getHomeUrl();}?>/img/logoprojeto1.png"/> </h1>
        <h2 class="lead" style="padding-top: 10px">Com o Inside Budget a gestão de orcamento dos seus clientes nunca foi tão fácil</h2>

    </div>

    <h2 align="center" style="padding-bottom: 30px">Junte-se ao site para ser um de nós!</h2>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h3 style="text-align: center">Instalador</h3>

                <p>Crie e gere os seus próprios clientes e seus orcamentos de forma intuitiva, automatizada com a grande variedade de produtos fornecida
                de uma forma eficaz e de qualidade, assim economizando o seu tempo.</p>
            </div>
            <div class="col-lg-6">
                <h3 style="text-align: center">Fornecedor</h3>

                <p>Crie e gere os seus próprios produtos juntado-se a um grupo de pessoas que fornece os seus produtos de uma forma eficaz e de qualidade.</p>
            </div>
        </div>
    </div>

</div>
