<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="mask"></div>
<div id="registration-modal" class="modal-layout">
    <div class="close"></div>
    <div class="modal-title">Регистрация</div>
    <form class="form-registration">
        <div class="form-modal">
            <label for="email" class="form-label email"></label>
            <input type="email" id="email" required placeholder="E-mail" class="form-input ">
        </div>
        <button type="submit" class="form-submit">Получить пароль</button>
    </form>
    <div class="subtitle">Войдите с помощью</div>
    <div class="modal-social">
        <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="fb"></a>
        <a href="https://vk.com/doctora_ua" target="_blank" class="vk"></a>
        <a href="https://plus.google.com/u/0/communities/100953407866228239745" target="_blank" class="google"></a>
    </div>
</div>

<?php
$this->registerJs('
    $(".close, .mask").click(function() {
        $(".mask , .modal-layout").hide();
        $("body").removeClass("modal-open");
    });
');
?>

<!--<div class="site-signup">-->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <p>Please fill out the following fields to signup:</p>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-lg-5">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'form-signup']); ?>
<!--            -->
<!--                --><?php //$form->field($model, 'email') ?>
<!---->
<!--                --><?php //$form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                    'captchaAction' => '/site/captcha',
//                    'template'      => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//                ]) ?>
<!--                <div class="form-group">-->
<!--                    --><?php //Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<!--                </div>-->
<!---->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
