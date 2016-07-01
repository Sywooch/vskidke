<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->email) ?>,</p>

    <p>Ваш новый пароль: <?= $password?></p><br>
    <p>Вы всегда сможете его изменить в личном кабинете.</p>
</div>
