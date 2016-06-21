<?php

/* @var $this yii\web\View */

use common\models\Categories;
use common\models\Discounts;
use frontend\components\LinkPager;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Vskidke.com';

/** @var Discounts $model */
$model;

?>
<?php Pjax::begin(); ?>
<div class="container main">
    <div class="content">
        <div class="filter-holder">
<!--            <div class="btn-holder">-->
<!--                <a href="--><?//= Url::to(['/discount/index', 'new' => 'SORT_DESC']); ?><!--"><button class="filter-btn">новинки</button></a>-->
<!--                <a href="--><?//= Url::to(['/discount/index', 'popular' => 'SORT_DESC']); ?><!--"><button class="filter-btn">популярные</button></a>-->
<!--            </div>-->
<!--            <div class="filter-select-block"><span class="descr">акций на странице</span>-->
<!--                <div class="select-filter">-->
<!--                    <select>-->
<!--                        <option>10</option>-->
<!--                        <option>20</option>-->
<!--                        <option>30</option>-->
<!--                        <option>40</option>-->
<!--                        <option>50</option>-->
<!--                    </select>-->
<!---->
<!--                </div>-->
<!--            </div>-->
        </div>
        <div class="item-list">
            <?php foreach ($models as $model): ?>
            <div class="item <?= array_rand(Categories::getColorClass(), 1); ?>">
                <div class="img-holder">
                    <a href="<?= Url::to(['/discount/view', 'id' => $model->discount_id]); ?>">
                        <img src="<?= $model->getImg('small'); ?>" onerror="src='../images/error_photo2.png'">
                    </a>
                    <?php if(!$model->discount_gift): ?>
                        <div class="label">
                            <div class="price">
                                <?php if($model->discount_percent): ?>
                                <div class="action">-<?= $model->discount_percent; ?>%</div>
                                <?php else: ?>
                                    <span class='old-price'><?= $model->discount_old_price; ?></span>
                                    <span class='new-price'><?= $model->discount_price; ?></span> грн
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="info-block">
                        <div class="views"><?= $model->discount_view; ?></div>
                        <div class="os-holder">
                            <a href="" class="android"></a>
                            <a href="" class="mac"></a>
                        </div>
                    </div>
                </div>
                <div class="text-holder">
                    <a href="<?= Url::to(['/discount/view', 'id' => $model->discount_id]); ?>">
                        <div class="item-title"><?= $model->discount_title; ?></div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination-holder">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);?>
        </div>
    </div>
    <aside class="sidebar-left sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
    <aside class="sidebar-right sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
</div>
<?php Pjax::end(); ?>