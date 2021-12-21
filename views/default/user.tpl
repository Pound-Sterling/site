<div class="main-title">
    <h1>Ваши регестрационые данные</h1>
</div>
<div class="user-page">
    <table border="0" id="user-data">
        <tr>
            <td>Логин (email)</td>
            <td>{$arUser['email']}</td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><input type="text" name="name" id="newName" value="{$arUser['name']}"></td>
        </tr>
        <tr>
            <td>Телефон</td>
            <td><input type="text" name="phone" id="newPhone" value="{$arUser['phone']}"></td>
        </tr>
        <tr>
            <td>Адресс</td>
            <td><textarea style="max-width:202px;width:202px;min-width:202px;" name="adress" id="newAdress">{$arUser['adress']}</textarea></td>
        </tr>
        <tr>
            <td>Новый пароль</td>
            <td><input name="pwd1" type="password" id="newPwd1" value=""></td>
        </tr>
        <tr>
            <td>Повтор нового пароля</td>
            <td><input name="pwd2" type="password" id="newPwd2" value=""></td>
        </tr>
        <tr>
            <td>Для того чтобы изменить пароль введите текущий пароль</td>
            <td><input name="curPwd" type="password" id="curPwd" value=""></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="button" value="Сохранить изменения" onclick="updateUserData();"></td>
        </tr>
    </table>
    <div class="main-title">
        <h2>Заказы:</h2>
    </div>
    {if ! $rsUserOrders}
    Нет заказов
    {else}




    <div class="order-table">
        {assign var=val value=0}
        {foreach $rsUserOrders as $item name=orders}

        <div class="order-table__item">
            <a href="#" onclick="showProducts('{$item['id']}', this); return false;">
                <div class="order-table__main">
                    <div class="order-table__main-flex">
                        <div class="order-table__info">
                            <div class="order-table__title">
                                <span class="order-table__span-header">№ {$item['id']} дата заказа:
                                    {$item['date_created']}</span>

                            </div>
                            <div class="order-table__status">
                                {if $item['status'] == 1}
                                <span>Выполнен</span>
                                {else}
                                <span>Не Выполнен</span>
                                {/if}
                            </div>
                        </div>
                        <div class="order-table__price">
                            <span class="order-table__span-header">Сумма заказа</span>
                            <span>{$rsSum[$val]} грн</span>
                        </div>
                        <div class="order-table__images">
                            {foreach $item['children'] as $itemChild name=products}
                            <div class="order-table__images-item">
                                <img src="{$itemChild['image']}">
                            </div>
                            {/foreach}
                        </div>
                        <div class="order-table__hide-btn">

                            <div class="chevron-link">
                                <span class="icon-chevron-down"></span>
                            </div>

                        </div>
                    </div>
                </div>
            </a>




            <div class="hideme order-table__details" id="purchasesForOrderId_{$item['id']}">
                <div class="order-table__details__comment">
                    <span>{$item['comment']}</span>
                    <span>Сумма заказа: {$rsSum[$val]} грн</span>
                    {if $item['date_payment'] != null}


                    <div style="display: flex; flex-direction: column;">
                        <span>Оплачено&nbsp;</span>
                        <span>Дата оплаты:</span>
                        <span>{$item['date_payment']}</span>
                    </div>

                    {else}
                    <span>Не оплачено</span>
                    {/if}
                    <span></span>

                </div>
                <div class="order-table__details__goods">
                    <div class="order-table__details__header">
                        <span>Товары</span>
                    </div>
                    {foreach $item['children'] as $itemChild name=products}


                    <div class="order-table__details__info">
                        <a href="/product/{$itemChild['product_id']}/" class="order-table__details__info-figure">

                            <div class="order-table__details__info-figure-image">
                                <img src="{$itemChild['image']}">
                            </div>
                            <div>
                                <span>{$itemChild['name']}</span>
                                <div style="margin-top: 5px; color:midnightblue">
                                    <span style="font-size: 14px;">Id товара</span>
                                    {$itemChild['product_id']}
                                </div>
                            </div>

                        </a>
                        <div class="order-table__details__info-options">
                            <div class="test__price">
                                <span class="tile__options">Цена</span>
                                <span class="tile__digit">{$itemChild['price']}</span>
                            </div>
                            <div class="test__amount">
                                <span class="tile__options">Количество</span>
                                <span class="tile__digit">{$itemChild['amount']}</span>
                            </div>
                            <div class="test__sum">
                                <span class="tile__options">Сумма</span>
                                <span class="tile__digit"> {$itemChild['price'] * $itemChild['amount']}</span>
                            </div>
                        </div>
                    </div>




                    {/foreach}
                </div>

            </div>
        </div>





        {assign var=val value=$val+1}
        {/foreach}
    </div>

</div>


{/if}
</div>