<?php

use common\helpers\StringHelper;
use common\models\Discounts;
use common\models\User;
use yii\helpers\Url;

/**@var User $company*/
$company;
/** @var Discounts $discount */
$discount;

$dateEnd     = new DateTime(date('Y-m-d'));
$dateCurrent = new DateTime($discount->discount_date_end);
$interval    = $dateEnd->diff($dateCurrent);

?>

<div class="container main">
    <div class="content fill">
        <div class="top-holder"><a href="<?= Url::previous(); ?>" class="back-btn">Назад</a>
            <div class="action-title-wrapp">
                <div class="time"><span class="time-count"><?= $interval->days; ?></span><span><?= StringHelper::trueWordForm($interval->days, 'День', 'Дня', 'Дней')?></span></div>
                <h2 class="action-title"><?= $discount->discount_title; ?></h2>
            </div>
        </div>
        <div class="info-wrapp">
            <div class="img-holder">
                <img src="<?= $company->relatedRecords['profile']->getImg('small'); ?>" onerror="src='../images/error_logo.png'">
            </div>
            <div class="info-holder">
                <div class="item-title"><?= $company->relatedRecords['profile']->profile_name; ?></div>
                <div class="item phone"><?= $company->relatedRecords['profile']->profile_phone; ?></div>
                <div class="item mail"><?= $discount->discount_view_email == '0' ? $company->email : ''; ?></div>
                <div class="item site"><?= $company->relatedRecords['profile']->profile_site; ?></div>
            </div>
            <div class="action-holder">
                <div class="label-wrapp">
                    <div class="label">
                        <div class="price">
                            <?php if($discount->discount_percent): ?>
                                <div class="action">-<?= $discount->discount_percent; ?>%</div>
                            <?php else: ?>
                                <span class='old-price'><?= $discount->discount_old_price; ?></span>
                                <span class='new-price'><?= $discount->discount_price; ?></span> грн
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map-holder"></div>
        <div class="text-holder">
            <div class="post-img-holder"><img src="<?= $discount->getImg('small'); ?>" onerror="src=&quot;../images/error_photo.png&quot;">
                <div class="link-wrapp"> <a href="#" class="liked">Избранное</a><a href="#" class="share">Поделиться</a></div>
            </div>
            <?= $discount->discount_text; ?>
        </div>
        <div class="page-title-wrapp">
            <h1 class="page-title">Комментарии</h1>
        </div>
        <form>
            <div class="add-comment-form">
                <input type="text" id="comment-username" name="username" placeholder="Введите Ваше имя" required class="form-input username">
                <label for="comment-username" class="form-label">*обязательное поле для заполнения</label>
                <textarea name="comment" placeholder="Введите текст сообщения" required class="form-input textarea"></textarea>
                <button type="submit" class="form-submit">Отправить</button>
            </div>
        </form>
        <div class="comment-list">
            <div class="comment-item">
                <div class="user-name">ИмяПользователя</div>
                <div class="date">17.12.2015 12:41</div>
                <div class="comment-text">Хорошое продложение!!!</div>
                <div class="img-holder"><img src="../images/v-icon.png"></div>
            </div>
            <div class="comment-item">
                <div class="user-name">ИмяПользователя</div>
                <div class="date">17.12.2015 12:41</div>
                <div class="comment-text">Хорошое продложение!!!</div>
                <div class="img-holder"><img src="../images/error_photo.png"></div>
            </div>
        </div>
    </div>
    <aside class="sidebar-left sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
    <aside class="sidebar-right sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
</div>