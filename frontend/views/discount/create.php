<?php
use common\models\Categories;
use common\models\Discounts;
use common\models\User;
use common\models\UserProfile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var User $userModel*/
$userModel;
/** @var UserProfile $profile */
$profile = $userModel->relatedRecords['profile'];
/** @var Discounts $discountModel */
$discountModel;
?>

<div class="container main">
    <div class="content">
        <div class="page-title-wrapp">
            <h1 class="page-title">Размещение скидки</h1>
        </div>
        <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
            <div class="example-block">
                <div class="subtitle">Так будет выглядить Ваша скидка:</div>
                <div class="item blue">
                    <div style="background:url(../images/error_photo.png) no-repeat 0 0; background-size:contain contain; " class="img-holder">
                        <div class="label">
                            <div class="action">-50%</div>
                        </div>
                        <!--.info-block
                        .views 123
                        .os-holder
                            a(href='').android
                            a(href='').mac
                        -->
                    </div>
                    <div class="text-holder">
                        <div class="item-title">Название скидки...</div>
                    </div>
                </div>
            </div>
            <div class="edit-form">
                <div class="img-block">
                    <img src="<?= $profile->getImg('small'); ?>" onerror="src=&quot;../images/error_logo.png&quot;">
                    <!--| <a href="#" class='img-add' onclick="document.getElementById('fileID').click(); return false;" />Добавить лого</a>-->
                    <!--| <input type="file" id="fileID" style="visibility: hidden;" />-->
                </div>
                <div class="inputs-block">
                    <div class="form-row">
                        <label for="company" class="form-label">Компания</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($profile, 'profile_name')->textInput([
                            'class' => 'form-input',
                            'id'    => 'company'
                        ])->label(''); ?>
                    </div>
                    <div class="form-row">
                        <label for="phone" class="form-label">Телефон</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($profile, 'profile_phone')->textInput([
                            'class' => 'form-input',
                            'id'    => 'phone'
                        ])->label(''); ?>
                    </div>
                    <div class="form-row">
                        <label for="e-mail" class="form-label">E-mail</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($userModel, 'email')->textInput([
                            'class' => 'form-input',
                            'id'    => 'e-mail'
                        ])->label(''); ?>
                    </div>
                    <div class="form-row">
                        <label for="site" class="form-label">Сайт</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($profile, 'profile_site')->textInput([
                            'class' => 'form-input',
                            'id'    => 'site'
                        ])->label(''); ?>
                    </div>
                </div>
            </div>
            <div class="search-place">
                <div class="form-row">
                    <div class="select-wrapp add-page">
                        <?= $form->field($discountModel, 'category_id')->dropDownList(
                            ArrayHelper::map(Categories::find()->all(), 'category_id', 'category_name'),
                            ['prompt' => 'Рубрика', 'class' => '']
                        )->label(false); ?>
<!--                        <select name="">-->
<!--                            <option value="1">Рубрика</option>-->
<!--                            <option value="2">Рубрика</option>-->
<!--                        </select>-->
                    </div>
                    <span class="descr">Период действия скидки:</span>
                    <div class="select-wrapp add-page">
                        <?= $form->field($discountModel, 'discount_date_start')->widget(DatePicker::className(), [
                            'language' => 'ru',
                            'value' => date('Y-m-d'),
                            'dateFormat' => 'yyyy-MM-dd',
                        ])->label(false)?>
<!--                        <select name="">-->
<!--                            <option value="1">01.01.2015</option>-->
<!--                            <option value="2">02.01.2015</option>-->
<!--                        </select>-->
                    </div><span class="descr">-</span>
                    <div class="select-wrapp add-page">
                        <?= $form->field($discountModel, 'discount_date_end')->widget(DatePicker::className(), [
                            'language' => 'ru',
                            'value' => date('Y-m-d'),
                            'dateFormat' => 'yyyy-MM-dd',
                        ])->label(false)?>
<!--                        <select name="">-->
<!--                            <option value="1">01.01.2015</option>-->
<!--                            <option value="2">02.01.2015</option>-->
<!--                        </select>-->
                    </div>
                </div>
                <div class="form-row checkbox-holder">
<!--                    <div class="checkbox">-->
                        <?= $form->field($discountModel, 'discount_app', [
                            'options' => ['class' => 'checkbox'],
                            'template' => '{input}
                                            <label for="Checkbox1">Разместить скидку в приложении</label>
                                            <span class="os-holder">
                                                <a href="" class="android"></a>
                                                <a href="" class="mac"></a>
                                            </span>{error}'
                        ])->input('checkbox', ['id' => 'Checkbox1'])->label(false); ?>

                    <?= $form->field($discountModel, 'discount_view_email', [
                        'options' => ['class' => 'checkbox'],
                        'template' => '{input}
                                        <label for="Checkbox2">Скрыть e-mail</label>
                                        {error}'
                    ])->input('checkbox', ['id' => 'Checkbox2', 'unchecked' => 0, 'checked' => 1])->label(false); ?>
                </div>
            </div>
            <div class="add-form">
                <div class="img-block">
                    <img id="blah" src="<?php if(!$discountModel->isNewRecord && !empty($discountModel->img)): ?><?= Yii::$app->params['uploadUrl'] . $discountModel->img; ?><?php else: ?>#<?php endif; ?>" onerror="src=&quot;../images/error_photo.png&quot;">
                    <a href="#" class='img-add' onclick="document.getElementById('fileID').click(); return false;" />Добавить лого</a>
                    <?= $form->field($discountModel, 'img')->fileInput([
                        'id'    => 'fileID',
                        'style' => 'visibility: hidden;'
                    ])->label(''); ?>
                </div>
                <div class="inputs-block">
                    <div class="form-row">
                        <?= $form->field($discountModel, 'user_id')->hiddenInput(['value' => $userModel->getId()])->label(false); ?>
                        <?= $form->field($discountModel, 'discount_title')->textInput(['class' => 'form-input', 'placeholder' => 'Название скидки'])->label(false)?>
                    </div>
                    <div class="form-row">
                        <?= $form->field($discountModel, 'discount_text')->textarea(['class' => 'form-input form-textarea', 'placeholder' => 'Введите текст'])->label(false); ?>
<!--                        <textarea name="action-descr" placeholder="Введите текст" class="form-input form-textarea"></textarea>-->
                    </div>
                    <div class="form-row radio-holder">
                        <div class="radio">
                            <input type="radio" id="radio1" name="type-action">
                            <label for="radio1" class="action-btn">Скидка</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="radio2" name="type-action" class="radio-btn">
                            <label for="radio2" class="action-btn">Подарок</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="radio3" name="type-action" class="radio-btn">
                            <label for="radio3" class="action-btn">Распродажа</label>
                        </div>
                    </div>
                    <div class="form-row price-holder">
                        <?= $form->field($discountModel, 'discount_old_price')->textInput([
                            'id'          => 'old-price',
                            'class'       => 'form-input price',
                            'placeholder' => 'Старая цена'
                        ])->label(false); ?>
                        <?= $form->field($discountModel, 'discount_price')->textInput([
                            'id'          => 'new-price',
                            'class'       => 'form-input price',
                            'placeholder' => 'Новая цена'
                        ])->label(false); ?>
                    </div>
                </div>
            </div>
            <div class="save-btn-holder">
                <?= Html::button('Разместить', ['class' => 'save-btn', 'type' => 'submit']); ?>
<!--                <button type="submit" class="save-btn">Разместить</button>-->
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <aside class="sidebar-left sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
    <aside class="sidebar-right sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
</div>