<?php
/**
 * @var User $model
 */
use common\models\User;
use common\models\UserProfile;
use kartik\file\FileInput;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var UserProfile $profile */
$profile = $model->relatedRecords['profile'];

?>
Компания: <?= $profile->profile_name; ?><br>
Телефон: <?= $profile->profile_phone; ?><br>
Сайт: <?= $profile->profile_site; ?><br>

<br><br><br>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model->relatedRecords['profile'], 'profile_name')->textInput(); ?>
    <?= $form->field($model->relatedRecords['profile'], 'profile_phone')->textInput(); ?>
    <?= $form->field($model->relatedRecords['profile'], 'profile_site')->textInput(); ?>

<?php if (!$model->relatedRecords['profile']->isNewRecord && !empty($model->relatedRecords['profile']->img)) { ?>
    <?= $form->field($model->relatedRecords['profile'], 'img')->widget(FileInput::className(), [
        'pluginOptions' => [
            'initialPreview' => [
                Html::img(Yii::$app->params['uploadUrl'] . $model->relatedRecords['profile']->img, ['class'=>'file-preview-image', 'alt'=>$model->relatedRecords['profile']->img, 'title'=>$model->relatedRecords['profile']->img]),
            ],
            'showPreview' => true,
            'showRemove'  => false,
            'showUpload'  => false,
            'browseLabel' => 'Выбрать изображение',

        ],

    ])?>
<?php } else { ?>
    <?= $form->field($model->relatedRecords['profile'], 'img')->widget(FileInput::className(), [
        'pluginOptions' => [
            'showPreview' => true,
            'showRemove'  => false,
            'showUpload'  => false,
            'browseLabel' => 'Выбрать изображение',
        ]

    ])?>
<?php } ?>

<?= Html::submitInput('Save'); ?>
<?php ActiveForm::end(); ?>
