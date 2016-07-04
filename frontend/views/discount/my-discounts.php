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
            <div class="btn-holder">
                <a href="<?= Url::to(['/discount/' . Yii::$app->controller->action->id, 'active' => true]); ?>"><button class="filter-btn <?= $active == true ? 'active' : ''?>">Активные</button></a>
                <a href="<?= Url::to(['/discount/' . Yii::$app->controller->action->id, 'archive' => true]); ?>"><button class="filter-btn <?= $archive == true ? 'active' : ''?>">Архивные</button></a>
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
                            <img src="<?= $model->getImg('small'); ?>" onerror="src='../images/error_photo2.png'">
                            <div class="label">
                                <div class="price">
                                    <?php if($model->discount_percent): ?>
                                        <div class="action">-<?= $model->discount_percent; ?>%</div>
                                    <?php elseif($model->discount_old_price && $model->discount_price): ?>
                                        <span class='old-price'><?= $model->discount_old_price; ?></span>
                                        <span class='new-price'><?= $model->discount_price; ?></span> грн
                                    <?php else: ?>
                                        <div class="gift"></div>
                                    <?php endif; ?>
                                </div>
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
    <aside class="sidebar-left sidebar">
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
    </aside>
    <aside class="sidebar-right sidebar">
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
    </aside>
</div>
<?php Pjax::end(); ?>