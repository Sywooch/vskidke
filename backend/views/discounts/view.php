

Home
Help
Application

Model Generator
CRUD Generator
Controller Generator
Form Generator
Module Generator
Extension Generator
CRUD Generator

This generator generates a controller and views that implement CRUD (Create, Read, Update, Delete) operations for the specified data model.
Model Class
Search Model Class
Controller Class
View Path
Base Controller Class
yii\web\Controller
Widget Used in Index Page
GridView
Enable I18N
Enable Pjax
Code Template
default (/home/vskidki/web/vskidke.test.mediaretail.com.ua/public_html/vendor/yiisoft/yii2-gii/generators/crud/default)

Click on the above Generate button to generate the files selected below:
Code File 	Action
controllers/DiscountsController.php 	unchanged
backend/views/discounts/_form.php 	create
backend/views/discounts/create.php 	create
backend/views/discounts/index.php 	create
backend/views/discounts/update.php 	create
backend/views/discounts/view.php 	create

backend/views/discounts/view.php
CTRL+C to copy
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Discounts */

$this->title = $model->discount_id;
$this->params['breadcrumbs'][] = ['label' => 'Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
            'user_id',
            'category_id',
            'city_id',
            'discount_view',
            'discount_title',
            'discount_text:ntext',
            'discount_date_start',
            'discount_date_end',
            'discount_app',
            'discount_view_email:email',
            'discount_price',
            'discount_old_price',
            'discount_percent',
            'discount_gift:ntext',
            'img',
            'date_create',
        ],
    ]) ?>

</div>

A Product of Yii Software LLC

Powered by Yii Framework
