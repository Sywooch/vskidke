<?php
/**
 * @var User $model
 */
use common\models\User;
use common\models\UserProfile;
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

<?= Html::submitInput('Save'); ?>
<?php ActiveForm::end(); ?>
