<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Resposta */

$this->title = 'Create Resposta';
$this->params['breadcrumbs'][] = ['label' => 'Respostas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resposta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
