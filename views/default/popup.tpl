<div class="popup" id="popup_login">
    <div class="popup__body">
        <div class="popup__content">
            <a href="" class="popup__close icon-close close-popup"></a>
            <div class="popup__title">Вход в систему</div>
            <div class="popup__main">
                <div class="popup__text">
                    <div class="person-item">
                        <label for="loginEmail">логин:</label>
                        <input type="text" id="loginEmail" name="email" tabindex="1"><br>
                    </div>
                    <div class="person-item">
                        <label for="loginPwd">пароль:</label>
                        <input type="password" id="loginPwd" name="loginPwd" tabindex="2"><br>
                    </div>
                    <input class="btn-person" type="submit" onclick="login();" id="loginBtn" value="Войти"
                        tabindex="3"><br>
                </div>
                <div class="popup__link">
                    <a class="popup-link" href="#popup_reg">Регистрация</a>
                </div>
                <div class="popup__link">
                    <a class="popup-link" href="#popup_rec">Забыли пароль?</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="popup" id="popup_reg">
    <div class="popup__body">
        <div class="popup__content">
            <a href="" class="popup__close icon-close close-popup"></a>
            <div class="popup__title">Регистрация</div>
            <div class="popup__main">
                <div class="popup__text">
                    <form action="#" id="form-reg">
                        <div id="registerBox">
                            <div class="person-item">
                                <label for="RegEmail">email:</label>
                                <input type="text" id="RegEmail" name="email" class="_req _email">
                            </div>
                            <div class="person-item">
                                <label for="RegPwd1">пароль:</label>
                                <input type="password" id="RegPwd1" name="pwd1" class="_req _pwd _pwd1">
                            </div>
                            <div class="person-item">
                                <label for="RegPwd2">повторить пароль:</label>
                                <input type="password" id="RegPwd2" name="pwd2" class="_req _pwd _pwd2">
                            </div>
                            <div class="person-item">
                                <div class="checkbox">
                                    <input id="formAgreement" type="checkbox" name="agreement"
                                        class="checkbox__input _req">
                                    <label for="formAgreement" class="checkbox__label"><span>Я даю свое согласие на
                                            обработку персональных данных в соответсвии с <a href="">Условиями</a>
                                            *</span></label>
                                </div>
                            </div>
                        </div>
                        <input class="btn-person" type="submit" value="Регистрация">
                        <form>
                </div>
                <div class="popup__link">
                    <a class="popup-link" href="#popup_login">Вход в систему</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="popup" id="popup_rec">
    <div class="popup__body">
        <div class="popup__content">
            <a href="" class="popup__close icon-close close-popup"></a>
            <div class="popup__title">Востановление пароля</div>
            <div class="popup__main">
                <div class="popup__text">
                    <div id="BoxRecover">
                        <div class="person-item">
                            <label for="email_recover">email:</label>
                            <input type="text" id="email_recover" name="email">
                        </div>
                    </div>
                    <input class="btn-person" type="button" onclick="recoverPass();" value="Востановление">
                </div>
                <div class="popup__link">
                    <a class="popup-link" href="#popup_login">Вход в систему</a>
                </div>
                <div class="popup__link">
                    <a class="popup-link" href="#popup_reg">Регистрация</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="popup" id="popup_recall">
    <div class="popup__body">
        <div class="popup__content">
            <a href="" class="popup__close icon-close close-popup"></a>
            <div class="popup__title">Звонок</div>
            <div class="popup__main">
                <div class="popup__text">
                    <div id="BoxRecall">
                        <div class="person-item">
                            <label for="rcl-phone">Укажите на какой номер перезвонить*:</label>
                            <input type="text" class="recall" id="rcl-phone" name="phone">
                        </div>
                        <div class="person-item">
                            <label for="rcl-name">Как к вам обращаться:</label>
                            <input type="text" class="recall" id="rcl-name" name="name">
                        </div>
                        <div style="margin-top:7px">
                            Мы можем перезвонить вам в ближайшее время
                        </div>

                        <input class="btn-person" type="button" onclick="recall();" value="Перезвонить">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- не удалятьь -->
<div class="popup" id="popup_ordefr">

    <form>

    </form>

</div>
<!-- не удалятьь -->

<div class="popup" id="popup_notify">
    <div class="popup__body">
        <div class="popup__content">
            <a href="" class="popup__close icon-close close-popup"></a>
            <div class="popup__title">Звонок</div>
            <div class="popup__main">
                <div class="popup__text">
                    <div id="BoxNotify">
                        <div class="person-item">
                            <label for="rcl-phone">Укажите на какой номер перезвонить*:</label>
                            <input type="text" class="recall" id="rcl-phone" name="phone">
                        </div>
                        <div class="person-item">
                            <label for="rcl-name">Как к вам обращаться:</label>
                            <input type="text" class="recall" id="rcl-name" name="name">
                        </div>
                        <div style="margin-top:7px">
                            Мы можем сообщить вам когда данный товар появиться в наличиии
                        </div>


                        <input class="btn-person" type="button" onclick="recall();" value="Сообщить">
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


<div class="popup" id="popup_order">
    <div class="popup__body">
        <div class="popup__content">
            <a href="" class="popup__close icon-close close-popup"></a>
            <div class="popup__title">Регистрация</div>
            <div class="popup__main">
                <div class="popup__text">
                    <form action="#" id="form-reg-order">
                        <div id="registerBoxOrder">
                            <div class="person-item">
                                <label for="RegEmailOrder">email:</label>
                                <input type="text" id="RegEmailOrder" name="email" class="_req _email">
                            </div>
                            <div class="person-item">
                                <label for="RegPwd1Order">пароль:</label>
                                <input type="password" id="RegPwd1Order" name="pwd1" class="_req _pwd _pwd1">
                            </div>
                            <div class="person-item">
                                <label for="RegPwd2Order">повторить пароль:</label>
                                <input type="password" id="RegPwd2Order" name="pwd2" class="_req _pwd _pwd2">
                            </div>
                            <div class="person-item">
                                <label for="RegNameOrder">Имя*:</label>
                                <input type="text" name="name" id="RegNameOrder" class="_req">
                            </div>
                            <div class="person-item">
                                <label for="RegPhoneOrder">Тел*:</label>
                                <input type="text" name="phone" id="RegPhoneOrder" class="_req">
                            </div>
                            <div class="person-item">
                                <label for="RegAdressOrder">Адресс*:</label>
                                <textarea name="adress" id="RegAdressOrder"
                                    placeholder="Адресс доставки товара(Новая Почта, Justin)" class="_req"></textarea>
                            </div>
                            <div class="person-item">
                                <div class="checkbox">
                                    <input id="formOrderAgreement" type="checkbox" name="agreement"
                                        class="checkbox__input _req">
                                    <label for="formOrderAgreement" class="checkbox__label"><span>Я даю свое
                                            согласие
                                            на
                                            обработку персональных данных в соответсвии с <a href="">Условиями</a>
                                            *</span>
                                    </label>
                                </div>
                            </div>
                            <input class="btn-person" type="submit" value="Регистрация">
                        </div>
                    </form>
                </div>
                <div class="popup__link">
                    <a class="popup-link" href="#popup">Вход в систему</a>
                </div>
            </div>

        </div>
    </div>
</div>