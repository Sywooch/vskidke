<?php

use common\models\City;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyAddresses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-addresses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')
        ->dropDownList(
            ArrayHelper::map(
                \common\models\User::find()->with('profile')->all(), 'id', 'profile.profile_name'),
            [
                'prompt' => 'Выбрать',
                'id' => 'user-id'
            ])
        ->label('Компания') ?>

    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'city_id', 'city_name'), ['prompt' => 'Выбрать'])->label('Город'); ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6])->label('Адресс') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('Телефон') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
