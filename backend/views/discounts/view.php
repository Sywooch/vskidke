<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Discounts */

$this->title = $model->discount_id;
$this->params['breadcrumbs'][] = ['label' => 'Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$profile = $model->getUser()->with('profile')->one();

?>
<div class="discounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->discount_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->discount_id], [
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
            'discount_id',
            [
                'label' => 'Компания',
                'value' => $profile->relatedRecords['profile']->profile_name
            ],
            [
                'label' => 'Рубрика',
                'value' => $model->getCategory()->one()->category_name
            ],
            'discount_title',
            'discount_text:ntext',
            'discount_date_start',
            'discount_date_end',
            [
                'label' => 'Скидка в приложении',
                'value' => $model->discount_app == 0 ? 'Нет' : 'Да'
            ],
            [
                'label' => 'Скрыть email',
                'value' => $model->discount_view_email == 0 ? 'Нет' : 'Да'
            ],
            'discount_price',
            'discount_old_price',
            'discount_percent',
            'discount_gift:ntext',
            [
                'label' => 'Изображение',
                'value' => $model->img
            ],
            'date_create',
        ],
    ]) ?>

</div>

A Product of Yii Software LLC

Powered by Yii Framework
