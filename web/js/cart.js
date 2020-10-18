$(document).ready(function () {

    var plus = $('.form-group--number .plus');
    var minus = $('.form-group--number .minus');
    var totalPrice = $('.ps-cart__total').children('h3').children('span').contents();
    var headerTotalPrice = $('.ps-cart__total').children('p').children('span').contents();

    plus.on('click', function () {
        var button = $(this);
        var cartRowId = $(this).parent().data('cartRowId');
        var action = "+";
        var rowSumm = button.closest('td').next('td').children('span').contents();
        var headerRow = $(".ps-cart-item__content[data-cart-row-id='" + cartRowId + "']").find('i');

        console.log(headerRow[1]);

        $.post("/cart/update/", {"cartRowId": cartRowId, "action": action}, function (response) {
            button.parent().find('input').val(response.products.quantity);
            rowSumm[0]['nodeValue'] = response.products.rowSumm;
            totalPrice[0]['data'] = response.products.totalPrice;
            headerTotalPrice[1]['data'] = response.products.totalPrice;
            headerRow[0]['innerHTML'] = response.products.quantity;
            headerRow[1]['innerHTML'] = response.products.rowSumm;
        });

    });

    minus.on('click', function () {
        var button = $(this);
        var cartRowId = $(this).parent().data('cartRowId');
        var quantity = Number($(this).parent().find('input').val());
        var action = "-";
        var rowSumm = button.closest('td').next('td').children('span').contents();
        var headerRow = $(".ps-cart-item__content[data-cart-row-id='" + cartRowId + "']").find('i');

        if (quantity > 1) {
            button.parent().find('input').val(quantity - 1);
            $.post("/cart/update/", {"cartRowId": cartRowId, "action": action}, function (response) {
                button.parent().find('input').val(response.products.quantity);
                rowSumm[0]['nodeValue'] = response.products.rowSumm;
                totalPrice[0]['data'] = response.products.totalPrice;
                headerTotalPrice[1]['data'] = response.products.totalPrice;
                headerRow[0]['innerHTML'] = response.products.quantity;
                headerRow[1]['innerHTML'] = response.products.rowSumm;
            });
        }
        ;
    });



});