<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Discounts */

$this->title = 'Update Discounts: ' . $model->discount_id;
$this->params['breadcrumbs'][] = ['label' => 'Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->discount_id, 'url' => ['view', 'id' => $model->discount_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="discounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
