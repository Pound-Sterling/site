<html>

<head>
    <title>{$pageTitle}</title>
    <link rel="stylesheet" href="{$templateWebPath}css/style.css" type="text/css">
    <link rel="stylesheet" href="{$templateWebPath}css/reset.css" type="text/css">
    <link rel="stylesheet" href="{$templateWebPath}css/icon.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

</head>

<body class="preload">
    <div class="wrapper">
        <!--  -->
        <div id="header">
            <div class="container">
                <div class="header__wrapper">
                    <div class="header__logo-wrap">
                        <a href="/">
                            <div class="icon-logo">

                            </div>
                        </a>
                    </div>
                    <div class="header__right-sect">
                        <div class="header__person">
                            {if isset($arUser)}
                            <div id="userBox">
                                <a href="/user/" id="userLink">{$arUser['displayName']}</a><br>
                                <a href="/user/logout/" onclick="logout()">Выход</a>
                            </div>
                            {else}

                            <div id="userBox" class="hideme">
                                <a href="#" id="userLink"></a><br>
                                <a href="/user/logout/" onclick="logout();">Выход</a>
                            </div>

                            {if ! isset($hideLoginBox)}
                            <div class="header__person-btns">
                                <div id="loginBox">
                                    <a href="#popup_login" class="person-active popup-link">Авторизация</a>
                                </div>

                                <div id="register">
                                    <a href="#popup_reg" class="person-active popup-link">Регистрация</a>
                                </div>
                            </div>

                            {/if}
                            {/if}
                        </div>
                        <div class="header__person-mob">
                            {if isset($arUser)}
                            <div id="userBoxM">
                                <div class="userBox-cont">
                                    <a href="/user/" id="userLinkM" class="icon-acc"></a>
                                    <a href="/user/logout/" onclick="logout()">Выход</a>
                                </div>
                            </div>
                            {else}

                            <div id="userBoxM" class="hideme">
                                <div class="userBox-cont">
                                    <a href="#" id="userLinkM" class="icon-acc"></a>
                                    <a href="/user/logout/" onclick="logout();">Выход</a>
                                </div>
                            </div>

                            {if ! isset($hideLoginBox)}
                            <div id="loginBoxM">
                                <a href="#popup_login" class="person-active popup-link icon-acc"></a>
                            </div>

                            {/if}
                            {/if}
                        </div>
                        <div class="menuCart">
                            <div class="menuCaption">

                                <a class="icon-shopping-basket" href="/cart/" title="Перейти в корзину">
                                    <span id="cartCnt">
                                        Корзина
                                    </span>
                                    <span id="cartCntItems">
                                        {if $cartCntItems > 0}{$cartCntItems}{else}0{/if}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__info">

            <div class="container">
                <div class="main__info-title">
                    <h1>ДО 31.08 - <span style="color:yellow;font-weight: bold;text-decoration:underline;"><i>СКИДКА
                                45%</i></span></h1>
                </div>
            </div>
        </div>
        <main class="main">
            <div class="container">
                <div class="main-breadcrumbs">
                    <div class="breadcrumbs-wrapper">
                        <div class="breadcrumbs">
                            {$rsBread}
                        </div>
                        <div class="breadcrumbs-back">
                            {$rsBread_back}
                        </div>
                    </div>
                </div>
                <div class="main__wrapper">
                    {include file='leftcolumn.tpl'}


                    <!--     -->

                    <div id="centerColumn">