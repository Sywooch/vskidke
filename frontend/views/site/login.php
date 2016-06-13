<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="mask"></div>
<div id="login-modal" class="modal-layout">
    <div class="close"></div>
    <div class="modal-title">Вход</div>
    <form class="form-registration">
        <div class="form-modal">
            <label for="login-email" class="form-label email"></label>
            <input type="email" id="login-email" required placeholder="E-mail" class="form-input ">
        </div>
        <div class="form-modal">
            <label for="login-pass" class="form-label pass"></label>
            <input type="login-email" id="login-pass" required placeholder="Пароль" class="form-input ">
        </div>
        <div class="label">Забыли пароль?</div>
        <button type="submit" class="form-submit">Войти</button>
    </form>
    <div class="registration-link">Регистрация </div>
    <div class="subtitle">Войдите с помощью</div>
    <div class="modal-social">
        <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="fb"></a>
        <a href="https://vk.com/doctora_ua" target="_blank" class="vk"></a>
        <a href="https://plus.google.com/u/0/communities/100953407866228239745" target="_blank" class="google"></a>
    </div>
</div>

<?php
//$this->registerJs('
//    $(".close, .mask").click(function() {
//        $(".mask , .modal-layout").hide();
//        $("body").removeClass("modal-open");
//    });
//');
//?>





<!--<div class="container main">-->
<!--    <div class="content">-->
<!--        <div class="col-lg-5">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'login-form']); ?>
<!---->
<!--                --><?php //$form->field($model, 'email')->textInput(['autofocus' => true]) ?>
<!---->
<!--                --><?php //$form->field($model, 'password')->passwordInput() ?>
<!---->
<!--                --><?php //$form->field($model, 'rememberMe')->checkbox() ?>
<!---->
<!--                <div style="color:#999;margin:1em 0">-->
<!--                    If you forgot your password you can --><?php //Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
<!--                </div>-->
<!---->
<!--                <div class="form-group">-->
<!--                    --><?php //Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                </div>-->
<!---->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
