<div class="order-page">
    <div class="main-title">
        <h2>Данные заказа</h2>
    </div>
    <form id="frmOrder" action="#">
        <div class="order-data">
            {assign var=val value=0}
            {foreach $rsProducts as $item name=products}
            <div class="order-data__item">
                <a href="/product/{$item['id']}/" class="order-data__item__title">
                    <div class="order-data__item__title-img">
                        <img src="{$item['image']}" alt="">
                    </div>
                    <div class="order-data__item__title-name">
                        <span>{$item['name']}</span>
                    </div>
                </a>
                <div class="order-data__item__price">
                    <div class="test__price">
                        <span class="tile__options">Цена</span>
                        <span id="itemPrice_{$item['id']}">
                            <input type="hidden" name="itemPrice_{$item['id']}" value="{$item['price']}">
                        </span>
                        <span class="tile__digit">{$item['price']} грн</span>
                    </div>
                    <div class="test__amount">
                        <span class="tile__options">Количество</span>
                        <span id="itemCnt_{$item['id']}">
                            <input type="hidden" name="itemCnt_{$item['id']}" value="{$item['cnt']}">
                        </span>
                        <span class="tile__digit">{$item['cnt']}</span>
                    </div>
                    <div class="test__sum">
                        <span class="tile__options">Сумма</span>
                        <span id="itemRealPrice_{$item['id']}">
                            <input type="hidden" name="itemRealPrice_{$item['id']}" value="{$item['realPrice']}">
                        </span>
                        <span class="tile__digit"> {$item['realPrice']} грн</span>
                    </div>
                </div>
            </div>

            {assign var=val value=$val+{$item['realPrice']}}
            {/foreach}
        </div>
        {$buttonClass = ""}
        <div class="order">
            <div class="main-title">
                <h2>Данные заказчика</h2>
            </div>
            {$name = $arUser['name']}
            {$phone = $arUser['phone']}
            {$adress = $arUser['adress']}
            {if isset($arUser)}
            <div id="order-active">
                <div id="orderUserInfoBox" {$buttonClass}>


                    <div id="BoxOrder">
                        <div class="person-item">
                            <label for="orderName">Имя*:</label>
                            <input class="_req" type="text" name="name" id="orderName" value="{$name}">
                        </div>
                        <div class="person-item">
                            <label for="orderPhone">Тел*:</label>
                            <input class="_req" type="text" name="phone" id="orderPhone" value="{$phone}">
                        </div>
                        <div class="person-item">
                            <label for="orderAdress">Адресс*:</label>
                            <textarea class="_req" name="adress" id="orderAdress">{$adress}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            {else}
            <div id="order-active" class="hideme">
                <div id="orderUserInfoBox" {$buttonClass}>
                    <div id="BoxOrder">
                        <div class="person-item">
                            <label for="orderName">Имя*:</label>
                            <input class="_req" type="text" name="name" id="orderName" value="{$name}">
                        </div>
                        <div class="person-item">
                            <label for="orderPhone">Тел*:</label>
                            <input class="_req" type="text" name="phone" id="orderPhone" value="{$phone}">
                        </div>
                        <div class="person-item">
                            <label for="orderAdress">Адресс*:</label>
                            <textarea class="_req" name="adress" id="orderAdress">{$adress}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btns-log-reg">
                <div id="loginBox">
                    <a href="#popup_login" class="btn-person person-active popup-link">Авторизация</a>
                </div>
                <div id="register">
                    <a href="#popup_order" class="btn-person person-active popup-link">Регистрация</a>
                </div>
            </div>

            {$buttonClass = hideme}
            {/if}
            <div class="item-cart__sum-price">
                <span>Сумма заказа:</span>
                <span class="">{$val} грн</span>
            </div>
            <div class="item-cart__btn">
                <input class="btn-person {$buttonClass}" type="submit" id="btnSaveOrder" value="Оформить заказ">
            </div>
        </div>
    </form>
</div>