<?php

?>

<footer class="footer">
    <div class="container wrapp">
        <nav>
            <ul class="nav-footer">
                <li><a href="#">О проэкте</a></li>
                <li><a href="#">Архив скидок</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </nav>
        <div class="social">
            <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="fb"></a>
            <a href="https://plus.google.com/u/0/communities/100953407866228239745" target="_blank" class="google"></a>
            <a href="https://plus.google.com/u/0/communities/100953407866228239745" target="_blank" class="ok"></a>
            <a href="https://vk.com/doctora_ua" target="_blank" class="twitter"></a>
            <a href="https://vk.com/doctora_ua" target="_blank" class="vk"></a>
            <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80%D0%B0-UA-1526716247624396" target="_blank" class="youtube"></a>
        </div>
    </div>
</footer>

<div class="modal-container">
    <div id="info-modal" class="modal-layout-wrapp">
        <div class="modal-layout">
            <div class="close"></div>
            <div class="modal-title">Внимание</div>
            <p>Данный функционал доступен ТОЛЬКО зарегистрированным компаниям!</p>
            <p>Пожалуйста, зарегистрируйтесь или выполните вход, если вы уже зарегестрированы.  </p>
        </div>
    </div>

    <div id="address-modal" class="modal-layout-wrapp address-modal">
        <div class="modal-layout">
            <div class="close"></div>
            <div class="search-place">
                <div class="form-row">
                    <div class="select-wrapp town">
                        <select name="city" id="city">
                            <option value="1">Киев</option>
                            <option value="2">Днепропетровск</option>
                        </select>
                    </div>
                    <input type="hidden" name="_csrf" value="">
                    <input type="hidden" id="userId" name="user_id" value="">
                    <input type="text" name="address" placeholder="Введите адрес" class="form-input address">
                    <input type="text" name="phone" placeholder="телефон" class="form-input phone">
                </div>
                <input id="" type="submit" value="Добавить адрес" class="form-submit">
            </div>

            <div class="map-holder"><script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=wRN6jKaovdUKSUGiikvEm7FlWUgvPByD&width=100%&height=240&lang=ru_RU&sourceType=constructor"></script></div>
            <div class="save-btn-holder">
                <button type="submit" class="save-btn">Сохранить</button>
            </div>
        </div>
    </div>
</div>