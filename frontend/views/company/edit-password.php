<?php

use common\models\User;
use common\models\UserProfile;
use yii\widgets\ActiveForm;

/** @var User $user */
$user;

/** @var UserProfile $profile */
$profile = $user->relatedRecords['profile'];
?>

<div class="container main">
    <div class="content">
        <div class="page-title-wrapp">
            <h1 class="page-title">Сменить пароль</h1>
        </div>
        <?php $form = ActiveForm::begin([

        ]); ?>
            <div class="edit-form pass">
                <div class="img-holder"><img src="<?= $profile->getImg('small'); ?>" onerror="src=&quot;../images/error_logo.png&quot;"></div>
                <div class="info-holder">
                    <div class="item"><?= $profile->profile_name; ?></div>
                    <div class="item"><?= $profile->profile_phone; ?></div>
                    <div class="item"><?= $user->email; ?></div>
                    <div class="item"><a href="<?= $profile->profile_site; ?>" target="_blank"><?= $profile->profile_site; ?></a></div>
                </div>
                <div class="inputs-wrapp">
                    <?= $form->field($model, 'password')->passwordInput([
                        'class' => 'form-input',
                        'placeholder' => 'Введите старый пароль'
                    ])->label(false); ?>
                    <?= $form->field($model, 'new_password')->passwordInput([
                        'class' => 'form-input',
                        'placeholder' => 'Введите новый пароль'
                    ])->label(false); ?>
                    <?= $form->field($model, 'password_repeat')->passwordInput([
                        'class' => 'form-input',
                        'placeholder' => 'Повторите новый пароль'
                    ])->label(false); ?>
                </div>
                <div class="save-btn-holder">
                    <button type="submit" class="save-btn">Сохранить</button>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <aside class="sidebar-left sidebar">
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
    </aside>
    <aside class="sidebar-right sidebar">
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
        <a href="#" class="sidebar-banner"><img src="/images/banner.png" onerror="src=&quot;/images/banner.png&quot;"></a>
    </aside>
</div>
