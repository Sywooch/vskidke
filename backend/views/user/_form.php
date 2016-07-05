<?php

use common\models\User;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'status')->dropDownList(User::getStatusesArray(), ['prompt' => 'Выбрать статус']); ?>

    <?= $form->field($profile, 'profile_name')->textInput(); ?>

    <?= $form->field($profile, 'profile_phone')->textInput(); ?>

    <?= $form->field($profile, 'profile_site')->textInput(); ?>

    <?php if (!$profile->isNewRecord && !empty($profile->img)): ?>
        <?= $form->field($profile, 'img')->widget(FileInput::className(), [
            'pluginOptions' => [
                'initialPreview' => [
                    Html::img(Yii::$app->params['uploadUrl'] .  $profile->img, ['class'=>'file-preview-image', 'alt'=>$profile->img, 'title'=>$profile->img]),
                ],
                'showPreview' => true,
                'showRemove'  => false,
                'showUpload'  => false,
                'browseLabel' => 'Выбрать изображение',

            ],

        ])?>
    <?php else: ?>
        <?= $form->field($profile, 'img')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showPreview' => true,
                'showRemove'  => false,
                'showUpload'  => false,
                'browseLabel' => 'Выбрать изображение',
            ]

        ])?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
