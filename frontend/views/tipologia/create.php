<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipologia */

$this->title = 'Create Tipologia';
$this->params['breadcrumbs'][] = ['label' => 'Tipologias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipologia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
