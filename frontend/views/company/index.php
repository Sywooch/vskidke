<?php
/**
 * @var User $model
 */
use common\models\User;
use common\models\UserProfile;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var UserProfile $profile */
$profile = $model->relatedRecords['profile'];
?>
Компания: <?= $profile->profile_name; ?><br>
Телефон: <?= $profile->profile_phone; ?><br>
Сайт: <?= $profile->profile_site; ?><br>

<br><br><br>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model->relatedRecords['profile'], 'profile_name')->textInput(); ?>
    <?= $form->field($model->relatedRecords['profile'], 'profile_phone')->textInput(); ?>
    <?= $form->field($model->relatedRecords['profile'], 'profile_site')->textInput(); ?>

    <?= $form->field($model->relatedRecords['profile'], 'profile_img')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'image/*',
            'class'  => 'file'
        ],
        'pluginOptions' => [
            'showRemove' => false,
            'showUpload' => false,
            'showCaption' => false,
            'showBrowse' => false,
            'browseOnZoneClick' => true,
            'previewClass' => 'file_preview',
            'image' => [

            ]
        ],
    ])?>

<?= Html::submitInput('Save'); ?>
<?php ActiveForm::end(); ?>
