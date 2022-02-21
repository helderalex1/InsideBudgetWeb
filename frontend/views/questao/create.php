<?php

use common\models\Assunto;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Questao */

$this->title = 'Criar Dúvidas e questões';
$this->params['breadcrumbs'][] = ['label' => 'Questões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacto-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
