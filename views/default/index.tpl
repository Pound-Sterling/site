<div class="index">

    <div class="index-title">
        <div class="main-title">
            <h1>Самые Популярные товары</h1>
        </div>
    </div>

    <div class="goods">
        {foreach $rsProducts as $item name=products}
        <div class="single-goods">
            <div class="product-img">
                <a href="/product/{$item['id']}/">
                    <div class="goods__img-wrapper">
                        <img src="{$item['image']}" class="goods__img" />
                    </div>
                </a>
            </div>
            <div class="product-name">
                <a href="/product/{$item['id']}/">{$item['name']}</a>
            </div>
            <div class="product-price">
                <span class="old-price">{$item['oldprice']} грн</span>
                <span class="cur-price">{$item['price']} грн</span>
            </div>
            <div class="person-cur">
                {if $item['status'] == 'true'}
                <span class="cur-status-yes">В наличии</span>
                {else}
                <span class="cur-status-no">Нету в наличии</span>
                {/if}
            </div>

            {if $item['status'] == 'true'}
            <div class="person-cart">
                <a id="addCart_{$item['id']}" class="icon-cart-arrow-down person-cart-link add-to-cart_{$item['id']}"
                    onClick="addToCart({$item['id']}); return false;" alt="Добавить в корзину"><span>Добавить в
                        корзину</span></a>
            </div>
                        <div class="person-recall">
                <a class="popup-link person-recall-link" href="#popup_recall"><span class="re-call icon-phone">Перезвонить</span></a>
            </div>
            {else}
                        <div class="person-cart">
                <a id="addCart_{$item['id']}" class=" person-cart-link add-to-cart_{$item['id']} cant-buy"
                    onClick="addToCartError(); return false;" alt="Добавить в корзину"><span class="icon-close">Нету в наличии</span></a>
                                    <div class="person-notify">
                    <a href="#popup_notify" class="popup-link person-notify-link"><span
                            class="re-call icon-phone">Сообщить...
                            </span></a>
                </div>
            </div>
            {/if}

            <span class="person-code">Код: {$item['code']}</span>
        </div>
        {/foreach}
    </div>
</div>