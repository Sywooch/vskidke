<?php
use common\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/email-confirm', 'token' => $user->email_confirm_token]);
?>

Здравствуйте, <?= Html::encode($user->email) ?>!

Для подтверждения адреса пройдите по ссылке:

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>

Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо.