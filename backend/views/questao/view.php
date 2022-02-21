<?php

use common\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use \common\models\Resposta;

/* @var $this yii\web\View */
/* @var $model common\models\Questao */

$this->title = 'Questão: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="questao-view">

    <h1># Questão: <?= $model->id ?> </h1>
    <h2>Assunto: <?= \common\models\Assunto::getNome(Html::encode($model->assunto_id)) ?></h2>
    <h4>Mensagem: <?= $model->mensagem ?></h4>
    <table class="table w-100">

    <?php for($i=0; $i< count($respostas); $i++ ){ ?>
        <?php $user = User::find()->select('email')->where(['id'=>$respostas[$i]['utilizador_id']])->asArray()->one();?>

        <tr class="row">
        <?php if($respostas[$i]['utilizador_id'] == Yii::$app->user->identity->getId()){ ?>
           <?php $model->email = $user['email'];?>
            <td class="col-md-12 border-bottom border-top-0 text-right">
                <p><?= $respostas[$i]['data'];?> | Você(<?= $model->email;?>):</p>
                <p><?=$respostas[$i]['texto'] ?></p>

            </td>
        <?php }else{?>
            <?php $model->email = $user['email'];?>
            <td class="col-md-12 border-bottom border-top-0 text-left" >
                <p><?= $respostas[$i]['data'];?> | Utilizador(<?= $model->email;?>):</p>
                <p><?=$respostas[$i]['texto'] ?> </p>
            </td>

        <?php }?>
        </tr>
    <?php }?>

    </table>
</div>


    <?php $form = ActiveForm::begin(['action' => ['/resposta/create'], 'method' => 'post']); ?>

    <?= $form->field($resposta, 'questao_id')->hiddenInput(['value'=>''.$model->id.''])->label(false); ?>

    <?= $form->field($resposta, 'texto') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

