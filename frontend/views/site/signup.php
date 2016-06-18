<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div id="registration-modal" class="modal-layout-wrapp">
    <div class="modal-layout">
        <div class="close"></div>
        <div class="modal-title">Регистрация</div>
        <?php $form = ActiveForm::begin([
            'id'    => 'form-signup',
            'class' => 'form-registration',
        ]); ?>
            <?= $form->field($model, 'email', ['options' => ['class' => 'form-modal']])
                     ->textInput(['id' => 'email', 'class' => 'form-input', 'placeholder' => 'E-mail'])
                     ->label('', ['for' => 'email', 'class' => 'form-label email']); ?>
        
            <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'form-modal']])->widget(Captcha::className(), [
                'captchaAction' => '/site/captcha',
                'template'      => '<div class="form-verify">{image}{input}</div>',
            ]) ?>
            <?= Html::submitButton('Получить пароль', ['class' => 'form-submit']); ?>
        <?php ActiveForm::end(); ?>
        <div class="subtitle">Войдите с помощью</div>
        <div class="modal-social">
            <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="fb"></a>
            <a href="https://vk.com/doctora_ua" target="_blank" class="vk"></a>
            <a href="https://plus.google.com/u/0/communities/100953407866228239745" target="_blank" class="google"></a>
        </div>
    </div>
</div>