<?php

use common\models\Banners;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banners-form">

    <?php $form = \kartik\form\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if (!$model->isNewRecord && !empty($model->img)): ?>
        <?= $form->field($model, 'img')->widget(FileInput::className(), [
            'pluginOptions' => [
                'initialPreview' => [
                    Html::img(Yii::$app->params['uploadUrl'] .  $model->img, ['class'=>'file-preview-image', 'alt'=>$model->img, 'title'=>$model->img]),
                ],
                'showPreview' => true,
                'showRemove'  => false,
                'showUpload'  => false,
                'browseLabel' => 'Выбрать изображение',
            ],

        ])?>
    <?php else: ?>
        <?= $form->field($model, 'img')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showPreview' => true,
                'showRemove'  => false,
                'showUpload'  => false,
                'browseLabel' => 'Выбрать изображение',
            ]
        ])?>
    <?php endif; ?>

    <?= $form->field($model, 'position')->dropDownList(Banners::getPositions(), ['prompt' => 'Выбрать']); ?>

    <?= $form->field($model, 'link')->textInput(['placeholder' => 'http://site.com']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php \kartik\form\ActiveForm::end(); ?>

</div>
