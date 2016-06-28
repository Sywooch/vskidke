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
        <?php echo \nodge\eauth\Widget::widget(['action' => '/site/login']); ?>
    </div>
</div>