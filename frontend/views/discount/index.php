<?php

?>

<div class="container main">
    <div class="content">
        <div class="page-title-wrapp">
            <h1 class="page-title">Размещение скидки</h1>
        </div>
        <form>
            <div class="example-block">
                <div class="subtitle">Так будет выглядить Ваша скидка:</div>
                <div class="item blue">
                    <div style="background:url(../images/error_photo.png) no-repeat 0 0; background-size:contain contain; " class="img-holder">
                        <div class="label">
                            <div class="action">-50%</div>
                        </div>
                        <!--.info-block
                        .views 123
                        .os-holder
                            a(href='').android
                            a(href='').mac
                        -->
                    </div>
                    <div class="text-holder">
                        <div class="item-title">Название скидки...</div>
                    </div>
                </div>
            </div>
            <div class="edit-form">
                <div class="img-block">
                    <img src="../images/error_logo.png" onerror="src=&quot;../images/error_logo.png&quot;">
                    <!--| <a href="#" class='img-add' onclick="document.getElementById('fileID').click(); return false;" />Добавить лого</a>-->
                    <!--| <input type="file" id="fileID" style="visibility: hidden;" />-->
                </div>
                <div class="inputs-block">
                    <div class="form-row">
                        <label for="company" class="form-label">Компания</label>
                        <a href="#" class="edit">Редактировать</a>
                        <input type="text" name="company" id="company" value="ТОВ “Ромашка”" class="form-input">
                    </div>
                    <div class="form-row">
                        <label for="phone" class="form-label">Телефон</label>
                        <a href="#" class="edit">Редактировать</a>
                        <input type="text" name="company" id="phone" value="8-800-00-00" class="form-input">
                    </div>
                    <div class="form-row">
                        <label for="e-mail" class="form-label">E-mail</label>
                        <a href="#" class="edit">Редактировать</a>
                        <input type="text" name="company" id="e-mail" value="ivan_ivanivich@mail.ua" class="form-input">
                    </div>
                    <div class="form-row">
                        <label for="site" class="form-label">Сайт</label>
                        <a href="#" class="edit">Редактировать</a>
                        <input type="text" name="company" id="site" value="www. romashka. ua" class="form-input">
                    </div>
                </div>
            </div>
            <div class="search-place">
                <div class="form-row">
                    <div class="select-wrapp add-page">
                        <select name="">
                            <option value="1">Рубрика</option>
                            <option value="2">Рубрика</option>
                        </select>
                    </div><span class="descr">Период действия скидки:</span>
                    <div class="select-wrapp add-page">
                        <select name="">
                            <option value="1">01.01.2015</option>
                            <option value="2">02.01.2015</option>
                        </select>
                    </div><span class="descr">-</span>
                    <div class="select-wrapp add-page">
                        <select name="">
                            <option value="1">01.01.2015</option>
                            <option value="2">02.01.2015</option>
                        </select>
                    </div>
                </div>
                <div class="form-row checkbox-holder">
                    <div class="checkbox">
                        <input type="checkbox" id="Checkbox1" name="Checkbox">
                        <label for="Checkbox1">Разместить скидку в приложении</label>
                        <span class="os-holder">
                            <a href="" class="android"></a>
                            <a href="" class="mac"></a>
                        </span>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="Checkbox2" name="Checkbox">
                        <label for="Checkbox2">Скрыть e-mail</label>
                    </div>
                </div>
            </div>
            <div class="add-form">
                <div class="img-block">
                    <img src="../images/error_photo.png" onerror="src=&quot;../images/error_photo.png&quot;">
                    <a href="#" class='img-add' onclick="document.getElementById('fileID').click(); return false;" />Добавить лого</a>
                    <input type="file" id="fileID" style="visibility: hidden;" />
                </div>
                <div class="inputs-block">
                    <div class="form-row">
                        <input type="text" name="action-name" placeholder="Название скидки" class="form-input">
                    </div>
                    <div class="form-row">
                        <textarea name="action-descr" placeholder="Введите текст" class="form-input form-textarea"></textarea>
                    </div>
                    <div class="form-row radio-holder">
                        <div class="radio">
                            <input type="radio" id="radio1" name="type-action">
                            <label for="radio1" class="action-btn">Скидка</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="radio2" name="type-action" class="radio-btn">
                            <label for="radio2" class="action-btn">Подарок</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="radio3" name="type-action" class="radio-btn">
                            <label for="radio3" class="action-btn">Распродажа</label>
                        </div>
                    </div>
                    <div class="form-row price-holder">
                        <input type="text" name="" id="old-price" placeholder="Старая цена" class="form-input price">
                        <input type="text" name="" id="new-price" placeholder="Новая цена" class="form-input price">
                    </div>
                </div>
            </div>
            <div class="save-btn-holder">
                <button type="submit" class="save-btn">Разместить</button>
            </div>
        </form>
    </div>
    <aside class="sidebar-left sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
    <aside class="sidebar-right sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
</div>