<?php

/* @var $this yii\web\View */

use common\models\Categories;
use common\models\Discounts;
use frontend\components\LinkPager;
use frontend\widgets\banners\BannerWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Vskidke.com';

/** @var Discounts $model */
$model;

$get = Yii::$app->request->get();
unset($get['city']);

?>
<?php Pjax::begin(); ?>
<div class="container main">
    <div class="content">
        <div class="filter-holder">
            <div class="btn-holder">
                <a href="<?= Url::to(['/discount/index', 'new' => 'SORT_DESC']); ?>" class="filter-btn <?= $new == 'SORT_DESC' ? 'active' : ''?>">новинки</a>
                <a href="<?= Url::to(['/discount/index', 'popular' => 'SORT_DESC']); ?>" class="filter-btn <?= $popular == 'SORT_DESC' ? 'active' : ''?>"> популярные</a>
            </div>
            <div class="filter-select-block"><span class="descr">акций на странице</span>
                <div class="select-filter">
                    <select id="limit-page">
                        <option <?= $limit == 10 ? 'selected' : ''; ?>
                                value="<?= Url::to(['/discount/index', 'limit' => 10])?>">
                            10
                        </option>
                        <option <?= $limit == 20 ? 'selected' : ''; ?>
                                value="<?= Url::to(['/discount/index', 'limit' => 20])?>">
                            20
                        </option>
                        <option <?= $limit == 30 ? 'selected' : ''; ?>
                                value="<?= Url::to(['/discount/index', 'limit' => 30])?>">
                            30
                        </option>
                        <option <?= $limit == 40 ? 'selected' : ''; ?>
                                value="<?= Url::to(['/discount/index', 'limit' => 40])?>">
                            40
                        </option>
                        <option <?= $limit == 50 ? 'selected' : ''; ?>
                                value="<?= Url::to(['/discount/index', 'limit' => 50])?>">
                            50
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="item-list">
            <?php foreach ($models as $model): ?>
            <?php
                if($model->discount_percent) {
                    $colorClass = Discounts::getColorClass($model->discount_percent);
                } elseif($model->discount_price && $model->discount_old_price) {
                    $colorClass = 'yellow';
                } elseif($model->discount_gift) {
                    $colorClass = 'pink';
                }
            ?>
            <div class="item <?= $colorClass ?>">
                <a href="<?= Url::to(['/discount/view', 'id' => $model->discount_id]); ?>">
                    <div class="img-holder">
                        <img src="<?= $model->getImg('small'); ?>" onerror="src='/images/error_photo2.png'">
                        <div class="label">

                                <?php if($model->discount_percent): ?>
                                    <div class="action">-<?= $model->discount_percent; ?>%</div>
                                <?php elseif($model->discount_old_price && $model->discount_price): ?>
                                    <div class="price">
                                        <span class='old-price'><?= $model->discount_old_price; ?></span>
                                        <span class='new-price'><?= $model->discount_price; ?></span> грн
                                    </div>
                                <?php else: ?>
                                    <div class="gift"></div>
                                <?php endif; ?>

                        </div>
                        <div class="info-block">
                            <div class="views"><?= $model->discount_view; ?></div>
                            <div class="os-holder">
                                <a href="" class="android"></a>
                                <a href="" class="mac"></a>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?= Url::to(['/discount/view', 'id' => $model->discount_id]); ?>">
                    <div class="text-holder">
                        <div class="item-title"><?= $model->discount_title; ?></div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination-holder">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);?>
        </div>
    </div>
    <?= BannerWidget::widget(); ?>
</div>
<?php Pjax::end(); ?>