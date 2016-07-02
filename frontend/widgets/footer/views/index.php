<?php
use common\models\City;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<footer class="footer">
    <div class="container wrapp">
        <nav>
            <ul class="nav-footer">
                <li><a href="#">О проекте</a></li>
                <li><a href="<?= Url::to(['/discount/archive']); ?>">Архив скидок</a></li>
                <li><a href="#">Условия размещения</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </nav>
        <div class="social">
            <a href="https://www.facebook.com/vskidke" target="_blank" class="fb"></a>
            <a href="https://plus.google.com/112076983030129168895" target="_blank" class="google"></a>
            <a href="http://ok.ru/group/54487909335043" target="_blank" class="ok"></a>
            <a href="https://twitter.com/vskidke_com" target="_blank" class="twitter"></a>
            <a href="https://new.vk.com/vskidke_com" target="_blank" class="vk"></a>
<!--            <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="youtube"></a>-->
        </div>
    </div>
<?php if(Yii::$app->getSession()->hasFlash('message')): ?>
    <a href="#" id="message" style="display: none;"></a>
<?php endif;?>
</footer>

<div class="modal-container">
    <div id="forgot-modal" class="modal-layout-wrapp">
        <div class="modal-layout">
            <div class="close"></div>
            <div class="modal-title">Забыли пароль?</div>
            <form class="form-registration">
                <div class="form-modal">
                    <label for="email" class="form-label email"></label>
                    <input type="email" id="email" required="required" placeholder="E-mail" class="form-input "/>
                </div>
                <button type="submit" class="form-submit">Отправить пароль</button>
            </form>
        </div>
    </div>

    <div id="search-modal" class="modal-layout-wrapp">
        <div class="modal-layout">
            <div class="close"></div>
            <div class="modal-title">Поиск</div>
            <?php ActiveForm::begin([
                'action' => Url::to(['/discount/index']),
                'method' => 'GET'
            ]); ?>
                <div class="form-modal">
                    <label for="email" class="form-label search"></label>
                    <input type="text" name="q"  placeholder="Поиск" class="form-input "/>
                </div>
                <button type="submit" class="form-submit">Найти</button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div id="info-modal" class="modal-layout-wrapp">
        <div class="modal-layout">
            <div class="close"></div>
            <div class="modal-title">Внимание</div>
            <p>Данный функционал доступен ТОЛЬКО зарегистрированным компаниям!</p>
            <p>Пожалуйста, зарегистрируйтесь или выполните вход, если вы уже зарегестрированы.  </p>
        </div>
    </div>

    <?php if(Yii::$app->getSession()->hasFlash('message')): ?>
        <div id="flash-modal" class="modal-layout-wrapp">
            <div class="modal-layout">
                <div class="close"></div>
<!--                <div class="modal-title">Внимание</div>-->
                <?php foreach (Yii::$app->getSession()->getAllFlashes() as $flash): ?>
                    <?= $flash; ?><br>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif;?>

    <div id="address-modal" class="modal-layout-wrapp address-modal">
        <div class="modal-layout">
            <div class="close"></div>
            <div class="search-place">
                <div class="select-wrapp town">
                    <?= Html::dropDownList('city', 'city_id', ArrayHelper::map(City::find()->all(), 'city_id', 'city_name'), ['id' => 'city']); ?>
                </div>
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
                <input type="hidden" id="userId" name="user_id" value="<?= Yii::$app->user->getId(); ?>">
                <input type="text" name="address" placeholder="Введите адрес" class="form-input address">
                <input type="text" name="phone" placeholder="телефон" class="form-input phone">
                <input id="searchAddress" type="submit" value="Добавить адрес" class="form-submit">
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
<!--            <div class="save-btn-holder">-->
<!--                <button type="submit" class="save-btn">Сохранить</button>-->
<!--            </div>-->
        </div>
    </div>
</div>

<?php
$this->registerJs('
                 $("#searchAddress").on(\'click\', function(event){
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
//                        var address = "<div class=\'address\'><label>" + data.address + "</label></div>"
                        $(".address-holder").appendTo(data.addressModel);
                    }, \'json\')
                }
            ');
?>