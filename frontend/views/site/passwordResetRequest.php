<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<div id="forgot-modal" class="modal-layout-wrapp">
    <div class="modal-layout">
        <div class="close"></div>
        <div class="modal-title">Забыли пароль?</div>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['/site/password-reset-request']),
            'enableAjaxValidation' => true,
            'id'     => 'request-password-reset-form', 
            'class'  => 'form-registration'
        ]); ?>
            <div class="form-modal">
                <label for="email" class="form-label email"></label>
                <?= $form->field($model, 'email')->textInput([
                    'autofocus'   => true,
                    'id'          => 'email',
                    'required'    => 'required',
                    'placeholder' => 'E-mail',
                    'class'       => 'form-input'
                ])->label(false); ?>
<!--                <input type="email" id="email" required="required" placeholder="E-mail" class="form-input "/>-->
            </div>
            <button type="submit" id="forgot-password" class="form-submit">Отправить пароль</button>
        <?php ActiveForm::end(); ?>
    </div>
</div>
