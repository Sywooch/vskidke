<?php
/**
 * @var User $model
 * @var $this View
 */
use common\models\City;
use common\models\CompanyAddresses;
use common\models\User;
use common\models\UserProfile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;



/** @var UserProfile $profile */
$profile   = $model->relatedRecords['profile'];
/** @var CompanyAddresses $address */
$address;

?>

<div class="container main">
    <div class="content">
        <div class="page-title-wrapp">
            <h1 class="page-title">Мои данные</h1>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['id' => 'companyForm', 'enctype' => 'multipart/form-data']]); ?>
            <div class="edit-form">
                <div class="img-block">
                    <img id="blah"
                         src="<?php if(!$model->relatedRecords['profile']->isNewRecord && !empty($model->relatedRecords['profile']->img)): ?>
                                  <?= Yii::$app->params['uploadUrl'] . $model->relatedRecords['profile']->img; ?>
                              <?php else: ?>
                                #
                              <?php endif; ?>"
                         onerror="src=&quot;../images/error_logo.png&quot;">

                    <a href="#" class='img-add' onclick="document.getElementById('fileID').click(); return false;" />Добавить лого</a>

                    <?php if(!$model->relatedRecords['profile']->isNewRecord && !empty($model->relatedRecords['profile']->img)): ?>
                        <?= $form->field($model->relatedRecords['profile'], 'img')->fileInput([
                            'id'    => 'fileID',
                            'style' => 'visibility: hidden;',
                        ])->label(false); ?>

                        <?= $form->field($model->relatedRecords['profile'], 'img')->hiddenInput(['value' => $model->relatedRecords['profile']->img])->label(false); ?>
                    <?php else: ?>
                        <?= $form->field($model->relatedRecords['profile'], 'img')->fileInput([
                            'id'    => 'fileID',
                            'style' => 'visibility: hidden;'
                        ])->label(''); ?>
                    <?php endif; ?>
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
                        <?= Html::dropDownList('city', 'city_id', ArrayHelper::map(City::find()->all(), 'city_id', 'city_name'), ['id' => 'city']); ?>
<!--                        <select name="city" id="city">-->
<!--                            <option value="1">Киев</option>-->
<!--                            <option value="2">Днепропетровск</option>-->
<!--                        </select>-->
                    </div>
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
                    <input type="hidden" id="userId" name="user_id" value="<?= $model->id; ?>">
                    <input type="text" name="address" placeholder="Введите адрес" class="form-input address">
                    <input type="text" name="phone" placeholder="телефон" class="form-input phone">
                </div>
                <input id="submit-id" type="submit" value="Добавить адрес" class="form-submit">
            </div>
            <div id="map" class="map-holder"></div>

            <script id="script" type="text/javascript">
                var map;
                function initMap(data) {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: data,
                        zoom: 17,
                        scrollwheel: false,
                    });

                    var marker = new google.maps.Marker({
                        map: map,
                        position: data,
                    });
                }
            </script>

            <div id="addresses" class="address-holder">
                <?php foreach ($model->relatedRecords['addresses'] as $address): ?>
                    <div class="address">
                        <label><?= $address->relatedRecords['city']->city_name . ', ' . $address->address . ', тел. ' . $address->phone; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="save-btn-holder">
                <button type="submit" class="save-btn edit">Сохранить</button>
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
<?php
$this->registerJs('
                 $("#submit-id").on(\'click\', function(event){
                        event.preventDefault();
                        var address = $(".address").val();
                        var phone   = $(".phone").val();
                        var city    = $( "#city option:selected").text();
                        var cityId  = $( "#city").val();
                        var userId  = $( "#userId").val();
                        var data = {
                            address: address,
                            phone: phone,
                            city: city,
                            city_id: cityId,
                            user_id: userId
                        };
                        
                        getGeoposition(data);
                        
                        if($("#map").css("display") == "none") {
                            $("#map").slideToggle(400);
                        }
                    });
                    
                    function getGeoposition(data) {
                    $.post(\'index.php?r=company/add-address\', data, function (data) {
                        initMap(data.coordinates);
                        var address = "<div class=\'address\'><label>" + data.address + "</label></div>"
                        $("#addresses").append(address);
                    }, \'json\')
                }
            ');
?>