<?php
use common\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var User $user */
?>

Здравствуйте, <?= Html::encode($user->email) ?>!<br>

используйте данные для входа на сайт:<br>

Email: <?= Html::encode($user->email) ?><br>
Password: <?= Html::encode($password) ?>