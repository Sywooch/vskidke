<?php

use common\helpers\StringHelper;
use common\models\Discounts;
use common\models\User;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**@var User $company*/
$company;
/** @var Discounts $discount */
$discount;

$dateEnd     = new DateTime(date('Y-m-d'));
$dateCurrent = new DateTime($discount->discount_date_end);
$interval    = $dateEnd->diff($dateCurrent);

if($discount->discount_percent) {
    $colorClass = Discounts::getColorClass($discount->discount_percent);
} elseif($discount->discount_price && $discount->discount_old_price) {
    $colorClass = 'yellow';
} elseif($discount  ->discount_gift) {
    $colorClass = 'pink';
}
?>

<div class="container main">
    <div class="content fill <?= $colorClass; ?>">
        <div class="top-holder"><a href="<?= Url::previous(); ?>" class="back-btn">Назад</a>
            <div class="action-title-wrapp">
                <div class="time">
                    <span class="time-count"><?= $interval->days; ?></span>
                    <span><?= StringHelper::trueWordForm($interval->days, 'День', 'Дня', 'Дней')?></span>
                </div>
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
        <div class="post-text-holder">
            <div class="post-img-holder">
                <span class="img-wrapp">
                    <img src="<?= $discount->getImg('small'); ?>" onerror="src=&quot;../images/error_photo2.png&quot;">
                </span>
<!--                <div class="link-wrapp"> <a href="#" class="liked">Избранное</a><a href="#" class="share">Поделиться</a></div>-->
            </div>
            <div class="text" style="word-break: break-all;">
                <?= $discount->discount_text; ?>
            </div>

        </div>
        <div class="page-title-wrapp">
            <h1 class="page-title">Комментарии</h1>
        </div>
        <?php $form = ActiveForm::begin([
            'action'  =>'/index.php?r=discount/comment',
            'options' => [
                'id'      => 'commentForm',
            ]
        ]); ?>
            <div class="add-comment-form">
                <?= $form->field($comment, 'name')->textInput([
                    'class' => 'form-input username',
                    'id'    => 'comment-username',
                    'placeholder' => 'Введите Ваше имя',
                ])->label(false); ?>
                <label for="comment-username" class="form-label">*обязательное поле для заполнения</label>
                <?= $form->field($comment, 'text')->textarea([
                    'class' => 'form-input textarea',
                    'placeholder' => 'Введите текст сообщения'
                ])->label(false); ?>
                <?= $form->field($comment, 'discount_id')->hiddenInput(['value' => $discount->discount_id])->label(false); ?>
                <?= $form->field($comment, 'date')->hiddenInput(['value' => Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'), 'php:Y-m-d H:i:s')])->label(false); ?>
                <?php if(!Yii::$app->user->isGuest): ?>
                    <?= $form->field($comment, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->getId()])->label(false); ?>
                <?php endif; ?>
                <button type="submit" class="form-submit">Отправить</button>
            </div>
        <?php ActiveForm::end(); ?>
        <div class="comment-list">
            <?php if($comments): ?>
                <?php foreach ($comments as $discountComment): ?>
                    <?php /** @var User $user */$user = $discountComment->getUser()->one(); ?>
                    <div class="comment-item">
                        <div class="user-name"><?= $discountComment->name; ?></div>
                        <div class="date"><?= $discountComment->date; ?></div>
                        <div class="comment-text"><?= $discountComment->text; ?></div>
                        <div class="img-holder">
                            <?php if($user): ?>
                                <img src="<?= $user->relatedRecords['profile']->getImg('small'); ?>" onerror="src='../images/error_photo.png'">
                            <?php else: ?>
                                <img src="../images/error_photo.png" onerror="src='../images/error_photo.png'">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <aside class="sidebar-left sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
    <aside class="sidebar-right sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
</div>