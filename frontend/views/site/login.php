<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div id="login-modal" class="modal-layout-wrapp">
    <div class="modal-layout">
        <div class="close"></div>
        <div class="modal-title">Вход</div>
        <?php $form = ActiveForm::begin([
            'id'    => 'login-form', 
            'class' => 'form-registration'
        ]); ?>
            <?= $form->field($model, 'email', ['options' => ['class' => 'form-modal']])
                     ->textInput(['id' => 'login-email', 'class' => 'form-input', 'placeholder' => 'E-mail', 'autofocus' => true])
                     ->label('', ['for' => 'login-email', 'class' => 'form-label email']); ?>

            <?= $form->field($model, 'password', ['options' => ['class' => 'form-modal']])
                     ->passwordInput(['id' => 'login-pass', 'class' => 'form-input', 'placeholder' => 'Пароль'])
                     ->label('', ['for' => 'login-pass', 'class' => 'form-label pass']) ?>

            <div class="label">Забыли пароль?</div>
            <?= Html::submitButton('Войти', ['class' => 'form-submit']); ?>
        <?php ActiveForm::end(); ?>
        <div class="registration-link"><a id="register" href="#">Регистрация</a></div>
        <div class="subtitle">Войдите с помощью</div>
        <?php
        if (Yii::$app->getSession()->hasFlash('error')) {
            echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
        }
        ?>
        <?php echo \nodge\eauth\Widget::widget(['action' => '/site/login']); ?>
<!--        <div class="modal-social">-->
<!--            <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="fb"></a>-->
<!--            <a href="https://vk.com/doctora_ua" target="_blank" class="vk"></a>-->
<!--            <a href="https://plus.google.com/u/0/communities/100953407866228239745" target="_blank" class="google"></a>-->
<!--        </div>-->

    </div>
</div>