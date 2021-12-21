<div class="product-page">
    <div class="product-page__images">
        <div class="product-page__images-wrappers">
            <div class="product-page__images-wrappers-wrap">
            </div>
        </div>
        <div class="target_menu">
            <div class="btn-prev icon-arrow-left" onclick="plusSlides(-1)"></div>
            <div class="dots">
            </div>
            <div class="btn-next icon-arrow-right" onclick="plusSlides(1)"></div>
        </div>
    </div>
    <div class="product-page__act">
        <div>
            <div class="product-page__name">
                <h3>{$rsProduct['name']}</h3>
            </div>
            <div class="product-page__prd-info">
                <div class="product-page__prd-info__left-col">
                    <div class="product-page__status">
                        {if $rsProduct['status'] == 'true'}
                        <span class="cur-status-yes">В наличии</span>
                        {else}
                        <span class="cur-status-no">Нету в наличии</span>
                        {/if}
                    </div>
                    <div class="product-page__code">
                        <span class="person-code">Код: {$rsProduct['code']}</span>
                    </div>
                </div>
                <div class="product-page__price">
                    <span class="old-price">{$rsProduct['oldprice']} грн</span>
                    <span class="cur-price">{$rsProduct['price']} грн</span>
                </div>
            </div>
        </div>

        <div class="product-page__btn">
            <div class="product-page__btn-wrapper">
                {if $rsProduct['status'] == 'true'}
                <a id="removeCart_{$rsProduct['id']}"
                    class="icon-check person-cart-link prs_act {if ! $itemInCart} hideme {/if}" class="person-cart-link"
                    href="#" onClick="removeFromCart({$rsProduct['id']}); return false;" alt="Удалить из корзины"
                    name="{$rsProduct['id']}">Удалить из корзины</a>
                <a id="addCart_{$rsProduct['id']}"
                    class="icon-cart-arrow-down  person-cart-link prs_add {if $itemInCart} hideme {/if}" href="#"
                    onClick="addToCart({$rsProduct['id']}); return false;" alt="Добавить в корзину">Добавить в
                    корзину</a>
                <div class="person-recall">
                    <a href="#popup_3" class="popup-link person-recall-link"><span
                            class="re-call icon-phone">Перезвонить</span></a>
                </div>
                {else}
                <a id="removeCart_{$rsProduct['id']}" class="person-cart-link cant-buy" class="person-cart-link"
                    href="#" onClick="addToCartError(); return false;" alt="Удалить из корзины"
                    name="{$rsProduct['id']}"><span class="icon-close">Нету в наличии</span></a>
                <div class="person-notify">
                    <a href="#popup_notify" class="popup-link person-notify-link"><span
                            class="re-call icon-phone">Сообщить...
                        </span></a>
                </div>
                {/if}

            </div>
        </div>
    </div>
    <div class="product-page__info">
        <div class="product-page__desc">
            <div class="product-page__desc-hide">
                {$rsProduct['description']}
            </div>
            <div class="product-page__desc-vis">
                <div class="product-page__desc-title">

                </div>
                <div class="product-page__desc-main">
                    <div class="product-page__desc-char">

                    </div>
                    <div class="product-page__desc-char-list">
                        <ul class="product-page__desc-char-ul">

                        </ul>
                    </div>
                    <div class="product-page__desc-value">

                    </div>
                    <div class="product-page__desc-value-list">
                        <ul class="product-page__desc-value-ul">

                        </ul>
                    </div>
                    <div class="product-page__desc-info">
                        <div class="product-page__desc-info-title">
                            Оплата и доставка
                        </div>
                        <div class="product-page__desc-info-main">
                            Весь товар в наличии на нашем складе, отправляем Новой Почтой, УкрПочтой. Отправку заказов
                            производим максимально быстро, чтобы Вы как можно скорее могли получить свой заказ. Способы
                            оплаты: Предоплата на карту ПриватБанка или МоноБанка, Наложенный платеж (ОПЛАТА ПРИ
                            ПОЛУЧЕНИИ).
                        </div>
                    </div>

                    <div class="product-page__info_img">
                        <div class="product-page__info_img-wrapper">
                            <div class="product-page__info_img-item">
                                <div class="product-page__info_img-item__image-wrapper">
                                    <img src="/images/products/fourelements/fst.webp"
                                        class="product-page__info_img-item__image">
                                </div>
                                <div class="product-page__info_img-item__text">
                                    <div class="product-page__info_img-item__text__title">
                                        <h2>Отправка в день заказа</h2>
                                    </div>
                                    <div class="product-page__info_img-item__text__info">

                                        <h3>Отправка с г. Днепр, в большинство городов Украины доставка 1
                                            день, сегодня заказали - завтра получили (подробнее уточняйте у менеджера
                                            при
                                            оформлении
                                            заказа).</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="product-page__info_img-item">
                                <div class="product-page__info_img-item__image-wrapper">
                                    <img src="/images/products/fourelements/scnd.webp"
                                        class="product-page__info_img-item__image">
                                </div>
                                <div class="product-page__info_img-item__text">
                                    <div class="product-page__info_img-item__text__title">
                                        <h2>Прямые поставки с фабрик</h2>
                                    </div>
                                    <div class="product-page__info_img-item__text__info">

                                        <h3>Работаем на прямую с проверенными фабриками, поэтому Вы получаете товар по
                                            самой
                                            выгодной цене на рынке Украины.</h3>
                                    </div>
                                </div>

                            </div>
                            <div class="product-page__info_img-item">
                                <div class="product-page__info_img-item__image-wrapper">
                                    <img src="/images/products/fourelements/thrd.webp"
                                        class="product-page__info_img-item__image">
                                </div>
                                <div class="product-page__info_img-item__text">
                                    <div class="product-page__info_img-item__text__title">
                                        <h2>Гарантия качества</h2>
                                    </div>
                                    <div class="product-page__info_img-item__text__info">

                                        <h3>Гарантируем возврат или обмен товара в кратчайшие сроки, если Вас что-либо
                                            не
                                            устроит.</h3>
                                    </div>
                                </div>

                            </div>
                            <div class="product-page__info_img-item">
                                <div class="product-page__info_img-item__image-wrapper">
                                    <img src="/images/products/fourelements/frth.webp"
                                        class="product-page__info_img-item__image">
                                </div>
                                <div class="product-page__info_img-item__text">
                                    <div class="product-page__info_img-item__text__title">
                                        <h2>Оплата при получении</h2>
                                    </div>
                                    <div class="product-page__info_img-item__text__info">
                                        <h3>Отправляем наложенным платежом (оплата при получении), Вы оплачиваете товар
                                            после
                                            осмотра в отделении Новой Почты или Укрпочты.</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>