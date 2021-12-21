var cart = {};
var sum = 0;

$('document').ready(function () {
    checkCart();
    showCnt();

    if ($('.cart-page').length > 0) {
        $('.sum-price-value').html(sum + ' грн');
    }


});

function checkCart() {
    if (localStorage.getItem('cart') != null) {
        cart = JSON.parse(localStorage.getItem('cart'));
    }
    if (localStorage.getItem('sum') != null) {
        sum = parseInt(localStorage.getItem('sum'));

    }
}

function showCnt() {
    var a = $('.item-cart__itemCnt-input');
    if (!sum) {
        for (var i = 0; i < a.length; i++) {
            a[i] = a[i].id;
            a[i] = a[i].replace(/\D+/, '');
            var itemPrice = parseInt($('#itemPrice_' + a[i]).attr('value'));
            var ic = $('#itemCnt_' + a[i]);
            ic.on('change', () => {

            });

            sum += parseInt(ic.val()) * itemPrice
        }
    }

    if (cart) {
        for (var i in cart) {
            var itemPrice = $(`#itemPrice_${i}`).attr('value')
            var ic = $('#itemCnt_' + i);
            ic.val(cart[i])

            $(`#itemRealPrice_${i}`).html(`${cart[i] * itemPrice} грн`)
        }
    }
    saveCartToLs()
}



function saveCartToLs() {
    localStorage.setItem('cart', JSON.stringify(cart));
    localStorage.setItem('sum', sum);
}



function addCnt(itemId) {
    if (!cart[itemId]) cart[itemId] = 1

    cart[itemId]++
    var itemPrice = parseInt($('#itemPrice_' + itemId).attr('value'));
    var sb = itemPrice * parseInt(cart[itemId])
    sum += sb;


    $('#itemCnt_' + itemId).val(cart[itemId]);
    $('.cont_' + itemId).addClass('hideme');
    $('.sum-price-value').html(`${sum} грн`);
    $('#itemRealPrice_' + itemId).html(`${sb} грн`);



    saveCartToLs()

}

function removeCnt(itemId) {
    cart[itemId]--;
    var itemPrice = parseInt($('#itemPrice_' + itemId).attr('value'));
    var sb = itemPrice * parseInt(cart[itemId])

    if (cart[itemId] <= 0) {
        $('#itemCnt_' + itemId).val(0);
        $('.cont_' + itemId).removeClass('hideme');
        return false;
    }
    else $('#itemCnt_' + itemId).val(cart[itemId]);

    var sb = itemPrice * parseInt(cart[itemId])
    sum -= sb;

    $('.sum-price-value').html(sum + ' грн');
    $('#itemRealPrice_' + itemId).html(`${sb} грн`);

    saveCartToLs()

}





// Добавление продукта в корзину
// @param integer id GET параметр - ID добавляемого товара
// @return в случае успеха - колво элементов в корзине)
function addToCart(itemId) {
    $.ajax({
        method: 'POST',
        async: true,
        url: "/cart/addtocart/" + itemId + '/',
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#cartCntItems').html(data['cntItems']);
                if ($('.product-page').length > 0) {
                    $('#removeCart_' + itemId).addClass('here-flex');
                    $('#removeCart_' + itemId).removeClass('hideme');
                    $('#addCart_' + itemId).removeClass('here-flex');
                    $('#addCart_' + itemId).addClass('hideme');
                }
                if ($('.cart-page').length > 0) {
                    $('#addCart_' + itemId).hide();
                    $('#removeCart_' + itemId).show();
                }

            }
        }
    });
    $('.add-to-cart_' + itemId).addClass('cur-buy');
    $('.add-to-cart_' + itemId).removeClass('icon-cart-arrow-down');
    $('.add-to-cart_' + itemId).addClass('icon-check');

}
function removeFromCart(itemId) {
    // console.log("js - removeFromCart(" + itemId + ")");
    $.ajax({
        method: 'POST',
        async: true,
        url: "/cart/removefromcart/" + itemId + '/',
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                if ($('.product-page').length > 0) {
                    $('#cartCntItems').html(data['cntItems']);
                    $('#removeCart_' + itemId).addClass('hideme');
                    $('#removeCart_' + itemId).removeClass('here-flex');
                    $('#addCart_' + itemId).removeClass('hideme');
                    $('#addCart_' + itemId).addClass('here-flex');
                } else {
                    $('#addCart_' + itemId).show();
                    $('#removeCart_' + itemId).hide();
                }
            }
        }
    });
}


// Получение данных с форм
//
//
function getData(obj_form) {
    var hData = {};
    $('input, textarea, select', obj_form).each(function () {
        if (this.name && this.name != '') {
            hData[this.name] = this.value;
            // console.log('hdata[' + this.name + ' ] = ', hData[this.name]);
        }
    });
    return hData;
}


//
// Востановление пароля
//
function recoverPass() {
    var postData = getData('#BoxRecover');
    console.log(postData);
    $.ajax({
        method: 'POST',
        async: true,
        url: "/user/recover/", // отправляет в контроллер аякс, если нет ошибок идём дальше
        data: postData,
        dataType: 'json',
        // контроллер использовал модель и модель вернула нам значение 
        success: function (data) { // модель вернула массив 
            if (data['success']) {
                const popupActive = document.querySelector('.popup.open');
                popupActive.classList.remove('open');
                alert('Мы отправили вам на почту ссылку, по которой вам нужно будет перейти');
            } else {
                alert('Данный эмэйл не зарегестрирован');
            }
        }
    });
}
// валидация при регистрации

$(document).ready(function () {

    const form_reg = $('#form-reg');
    const form_reg_order = $('#form-reg-order');
    const form_order = $('#frmOrder');

    form_reg.submit(formSend);
    form_reg_order.submit(formSend);
    form_order.submit(formOrder);

    async function formOrder(e) {
        e.preventDefault();
        let error = formValidate($(this));
        if (error === 0) {
            saveOrder($(this));
        }
    }

    async function formSend(e) {
        e.preventDefault();
        let error = formValidate($(this));
        if (error === 0) {
            registerNewUser($(this));
        }
    }

    function formValidate(form) {
        let error = 0;
        let formReq = form.find('._req');
        $('.error').remove();
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);
            if ($(input).hasClass('_email')) {

                if (emailTest(input)) {
                    formAddError(input);
                    error++;
                    var b = $(input);
                    b.after('<span class="error">Введите коректный email</span>');
                }
            } else if ($(input).hasClass('_pwd')) {
                if (pwdTest(input)) {
                    formAddError(input);
                    error++;
                    var b = $(input);
                    b.after('<span class="error">Пароль должен содержать от 6 до 25 символов</span>');
                }
            } else if ($(input).hasClass('_pwd1')) {
                var a = input.value;
            } else if ($(input).hasClass('_pwd2')) {
                var a2 = input.value;
                if (a !== a2) {
                    formAddError(input);
                    error++;
                    var b = $(input);
                    b.after('<span class="error">Пароли не совпадают</span>');
                }



            } else if (input.getAttribute('type') === "checkbox" && input.checked === false) {
                formAddError(input);
                error++;
            } else {
                if (input.value === '') {
                    formAddError(input);
                    error++;
                    var b = $(input);
                    b.after('<span class="error">Пожалуйста, заполните это поле</span>');
                }
            }
        }
        return error;
    }

    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }
    function formRemoveError(input) {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }
    function emailTest(input) {
        return !/^.+@.+\..+$/.test(input.value);
    }
    function pwdTest(input) {
        return !/^[a-zA-Z0-9]{6,25}$/.test(input.value);
    }


});


//  Регистрация нового пользователя
//
//
function registerNewUser(a) {
    var postData = getData(a);
    console.log(postData);
    $.ajax({
        method: 'POST',
        async: true,
        url: "/user/register/", // отправляет в контроллер аякс, если нет ошибок идём дальше
        data: postData,
        dataType: 'json',
        // контроллер использовал модель и модель вернула нам значение 
        success: function (data) { // модель вернула массив 
            if (data['success']) {
                $('#register').hide();
                // работа с блоком после регистрации
                $('#userLinkM').attr('href', '/user/');

                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['userName']);
                $('#userBox').show();
                $('#userBoxM').show();

                // /cart/order/
                $('#order-active').show();

                // страница заказа
                $('#loginBox').hide();
                $('#loginBoxM').hide();
                $('#btnSaveOrder').show();
                // popup
                const popupActive = document.querySelector('.popup.open');
                popupActive.classList.remove('open');


            } else {
                alert(data['message']);

            }
        }
    });
}
function logout() {
    $('#userBox').hide();
    $('#register').show();
}
function login() {
    var email = $('#loginEmail').val();
    var pwd = $('#loginPwd').val();

    var postData = "email=" + email + "&pwd=" + pwd;
    // console.log(postData);

    $.ajax({
        method: 'POST',
        async: true,
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#register').hide();
                $('#loginBox').hide();
                $('#loginBoxM').hide();


                $('#userLinkM').attr('href', '/user/');
                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['displayName']);
                $('#userBox').show();
                $('#userBoxM').show();

                // /cart/order/
                $('#order-active').show();

                $('#name').val(data['name']);
                $('#phone').val(data['phone']);
                $('#adress').val(data['adress']);
                const popupActive = document.querySelector('.popup.open');
                popupActive.classList.remove('open');


                $('#btnSaveOrder').show();
            } else {
                alert(data['message']);
            }
        }

    });
}

// Обновление данных пользователя
//

function updateUserData() {
    // console.log('js - updateUserData()');
    var postData = getData('#user-data');

    $.ajax({
        method: 'POST',
        async: true,
        url: "/user/update/",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#userLink').html(data['userName']);
                alert(data['message']);
            } else {
                alert(data['message']);
            }
        }
    });
}
// Сохранения заказа
//
function saveOrder(a) {
    var postData = getData(a);
    console.log(postData);
    $.ajax({
        method: "POST",
        async: true,
        url: "/cart/saveorder/",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                alert(data['message']);
                document.location = '/';
            } else {
                alert(data['message']);
            }
        }
    });
}

function showProducts(id, th) {
    $(th).find('.icon-chevron-down').toggleClass('active-hide');
    var objName = "#purchasesForOrderId_" + id;
    if ($(objName).css('display') != 'flex') {
        $(objName).css('display', 'flex');
        $(th).find('.order-table__price').hide();
        $(th).find('.order-table__images').hide();
    } else {
        $(objName).css('display', 'none');
        $(th).find('.order-table__price').show();
        $(th).find('.order-table__images').show();


    }

}



if ($('.product-page').length > 0) {
    Image();
    $(desc());
}

function getDataImg(obj_form) {
    var hData = {};
    $('a', obj_form).each(function () {
        if (this.name && this.name != '') {
            hData['id'] = this.name.replace('addCart_', '');
            // console.log('hdata[' + this.id + ' ] = ', hData[this.name]);
        }
    });
    return hData;
}


function Image() {
    var postData = getDataImg('.product-page');
    // console.log(postData);
    $.ajax({
        method: 'POST',
        async: true,
        url: "/product/image/",
        data: postData,
        dataType: 'json',
        success: function (data) {
            let w = data['image'];
            let w_arr = w.replace(/\s+/g, " ").replace(/,/g, "").split(" ");
            j = 1;
            for (var i = 0; i < w_arr.length; i++) {
                const newElement = document.createElement('div');
                const dots = document.createElement('div');
                newElement.className = 'mySlides fade';
                dots.className = 'dot';
                dots.setAttribute('onclick', 'currentSlide(' + j + ')');
                $('.product-page__images-wrappers-wrap').append(newElement);
                if (i == 0) {
                    dots.className = 'dot active';
                }
                $('.dots').append(dots);
                if (i == 0) {
                    newElement.style.display = "block";
                    newElement.innerHTML = '<img class="product-page__img_' + i + '">';
                } else {
                    newElement.innerHTML = '<img class="product-page__img_' + i + '">';
                    newElement.style.display = "none";
                }
                $('.product-page__img_' + i).attr({ "src": w_arr[i] });
                j++;
            }
        }
    });
}

function desc() {
    var k = 0;

    var a = $('.product-page__desc-hide').text();
    w_arr = a.replace(/\s+/g, " ").split(" ");
    var b_arr = [];
    var b = 0;
    var v_arr = [];
    var v = 0;
    var g = 0;
    for (var i = 0; i < w_arr.length; i++) {
        if (/Хра[а-я:]+/.test(w_arr[i])) {
            w_arr[1] = "Характеристики:";
            w_arr[2] = w_arr[2].replace(w_arr[2], "");
            k++;
            i++;
            g++;
        }
        if (/Хар[а-я:]+/.test(w_arr[i])) {
            w_arr[1] = w_arr[i];
            w_arr[2] = w_arr[2].replace(w_arr[2], "");
            k++;
            i++;
            g++;
        }
        if (/Дос[а-я:]+/.test(w_arr[i])) {
            w_arr[3] = w_arr[i];
            w_arr[4] = w_arr[4].replace(w_arr[4], "");
            k++;
            i++;
        }

        if (/Това[а-я:]+/.test(w_arr[i])) {
            break;
        }
        if (k == 0) {
            w_arr[0] += w_arr[i] + ' ';
        }
        if (k == 1) {

            if (/[А-Яа-я]+:/.test(w_arr[i + 1]) && g == 0) {
                if (!/.+;/.test(w_arr[i])) {
                    w_arr[i] = w_arr[i].replace(w_arr[i], w_arr[i] + ';');
                }
            }
            if (/[а-я]+;/.test(w_arr[i]) || /;/.test(w_arr[i])) {
                b_arr[b] += w_arr[i];
                b++;
            }
            else {

                b_arr[b] += w_arr[i] + ' ';
            }
            if (g == 1) g--;
        }
        // console.log(w_arr[i]);

        if (k == 2) {
            if (/[а-я]+;/.test(w_arr[i]) || /;/.test(w_arr[i])) {
                v_arr[v] += w_arr[i];
                v++;
            }
            else {
                v_arr[v] += w_arr[i] + ' ';
            }
        }
    }



    // создание и обработка li элементов 
    for (var p = 0; p < b_arr.length; p++) {
        b_arr[p] = b_arr[p].replace(/undefined/, "");
        if (!/;/.test(b_arr[p])) {
            b_arr.splice(p, 1);
        }
        if (b_arr[p] != undefined) {
            const newLi = document.createElement('li');
            newLi.className = 'product-page__desc-char-ul-item';
            $('.product-page__desc-char-ul').append(newLi);
            newLi.innerHTML = b_arr[p];
        }
    }

    // создание и обработка li элементов 
    for (var p = 0; p < v_arr.length; p++) {
        v_arr[p] = v_arr[p].replace(/undefined/, "");
        if (!/;/.test(b_arr[p])) {
            b_arr.splice(p, 1);
        }
        if (v_arr[p] != undefined) {
            const newLiV = document.createElement('li');
            newLiV.className = 'product-page__desc-value-ul-item';
            $('.product-page__desc-value-ul').append(newLiV);
            newLiV.innerHTML = v_arr[p];
        }
    }



    $('.product-page__desc-title').text(w_arr[0]);
    $('.product-page__desc-char').text(w_arr[1]);
    if (k == 2) $('.product-page__desc-value').text(w_arr[3]);
}


