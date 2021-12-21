<div class="cart-page">
    <div class="main-title">
        <h1>Корзина</h1>
    </div>

    {if ! $rsProducts}
    В корзине пусто.
    {else}
    <form action="/cart/order/" method="POST">
        <div class="items-group">
            {foreach $rsProducts as $item name=products}
            <div class="item-cart">
                <div class="item-cart__img-wrapper">
                    <a href="/product/{$item['id']}/"><img src="{$item['image']}" class="item-cart__img"></a>
                </div>
                <div class="item-cart__info-cell">
                    <div class="item-cart__main-info">
                        <div class="item-cart__title">
                            <a href="/product/{$item['id']}/">{$item['name']}</a>
                        </div>
                    </div>
                    <div class="item-cart__infoPrice">
                        <div class="item-cart__itemCnt">
                            <div class="item-cart__cntBtns">
                                <div class="item-cart__cntChange" onclick="removeCnt({$item['id']})">-</div>
                                <input class="item-cart__itemCnt-input" name="itemCnt_{$item['id']}"
                                    id="itemCnt_{$item['id']}" type="text" value="1"
                                    onchange="conversionPrice({$item['id']});">
                                <div class="item-cart__cntChange" onclick="addCnt({$item['id']})">+</div>
                            </div>
                            <div class="item-cart__cntError-cont cont_{$item['id']} hideme">
                                <span class="item-cart__cntError">
                                    Минимальное количество для заказа 1 шт.
                                </span>
                            </div>

                        </div>
                        <div class="item-cart__Price">
                            <div class="item-cart__itemPrice">
                                <span class="item-cart__itemPrice-span">Цена:&nbsp;</span>
                                <div class="item-cart__itemPrice-price" id="itemPrice_{$item['id']}"
                                    value="{$item['price']}">
                                    {$item['price']} грн
                                </div>
                            </div>
                            <div class="item-cart__itemRealPrice">
                                <span>Сумма:&nbsp;</span>
                                <span id="itemRealPrice_{$item['id']}">
                                    {$item['price']}грн
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-cart__delete-block">
                    <div class="item-cart__delete">
                        <a class="icon-trash" id="removeCart_{$item['id']}" href="#"
                            onClick="removeFromCart({$item['id']}); return false;"></a>
                        <a class="icon-trash-restore hideme" id="addCart_{$item['id']}" href="#"
                            onClick="addToCart({$item['id']}); return false;"></a>
                    </div>
                </div>
            </div>
            {/foreach}
        </div>

        <div class="item-cart__sum-price">
            <span>Сумма заказа:</span>
            <span class="sum-price-value"></span>
        </div>
        <div class="item-cart__btn">
            <input class="btn-person" type="submit" value="Оформить заказ">
        </div>
    </form>
    {/if}
</div>