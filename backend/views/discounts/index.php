<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discounts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Discounts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'discount_id',
            'user_id',
            'category_id',
            'city_id',
            'discount_view',
            // 'discount_title',
            // 'discount_text:ntext',
            // 'discount_date_start',
            // 'discount_date_end',
            // 'discount_app',
            // 'discount_view_email:email',
            // 'discount_price',
            // 'discount_old_price',
            // 'discount_percent',
            // 'discount_gift:ntext',
            // 'img',
            // 'date_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
