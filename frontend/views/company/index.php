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

<div class="container main">
    <div class="content">
        <div class="page-title-wrapp">
            <h1 class="page-title">Мои данные</h1>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['id' => 'company', 'enctype' => 'multipart/form-data']]); ?>
            <div class="edit-form">
                <div class="img-block">
                    <img id="blah" src="<?php if(!$model->relatedRecords['profile']->isNewRecord && !empty($model->relatedRecords['profile']->img)): ?><?= Yii::$app->params['uploadUrl'] . $model->relatedRecords['profile']->img; ?><?php else: ?>#<?php endif; ?>" onerror="src=&quot;../images/error_logo.png&quot;">
                    <a href="#" class='img-add' onclick="document.getElementById('fileID').click(); return false;" />Добавить лого</a>
                    <?= $form->field($model->relatedRecords['profile'], 'img')->fileInput([
                        'id'    => 'fileID',
                        'style' => 'visibility: hidden;'
                    ])->label(''); ?>
<!--                    <input type="file" id="fileID" style="visibility: hidden;" />-->
                </div>
                <div class="inputs-block">
                    <div class="form-row">
                        <label for="company" class="form-label">Компания</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($model->relatedRecords['profile'], 'profile_name')->textInput([
                            'class' => 'form-input',
                            'id'    => 'company'
                        ])->label(''); ?>
                    </div>
                    <div class="form-row">
                        <label for="phone" class="form-label">Телефон</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($model->relatedRecords['profile'], 'profile_phone')->textInput([
                            'class' => 'form-input',
                            'id'    => 'phone'
                        ])->label(''); ?>
                    </div>
                    <div class="form-row">
                        <label for="e-mail" class="form-label">E-mail</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($model, 'email')->textInput([
                            'class' => 'form-input',
                            'id'    => 'e-mail'
                        ])->label(''); ?>
                    </div>
                    <div class="form-row">
                        <label for="site" class="form-label">Сайт</label>
                        <a href="#" class="edit">Редактировать</a>
                        <?= $form->field($model->relatedRecords['profile'], 'profile_site')->textInput([
                            'class' => 'form-input',
                            'id'    => 'site'
                        ])->label(''); ?>
                    </div>
                </div>
            </div>
            <div class="search-place">
                <div class="form-row">
                    <div class="select-wrapp town">
                        <select name="city" id="city">
                            <option value="1">Киев</option>
                            <option value="2">Днепропетровск</option>
                        </select>
                    </div>
                    <input type="text" name="address" placeholder="Введите адрес" class="form-input address">
                    <input type="text" name="phone" placeholder="телефон" class="form-input phone">
                </div>
                <input id="submit-id" type="submit" value="Найти адрес" class="form-submit">
            </div>
            <div id="map" class="map-holder"></div>
            <script id="script" type="text/javascript">
                var map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: -34.397, lng: 150.644},
                        zoom: 8
                    });
                }
            </script>
        <div class="save-btn-holder">
                <button type="submit" class="save-btn">Сохранить</button>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <aside class="sidebar-left sidebar">
        <a href="#" class="sidebar-banner">
            <img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;">
        </a>
        <a href="#" class="sidebar-banner">
            <img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;">
        </a>
    </aside>
    <aside class="sidebar-right sidebar">
        <a href="#" class="sidebar-banner">
            <img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;">
        </a>
        <a href="#" class="sidebar-banner">
            <img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;">
        </a>
    </aside>
</div>
