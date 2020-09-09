$('.colorElement').on('click', function (e) {
    e.preventDefault();
    $('.colorElement').not(this).removeClass('selected');
    $(this).addClass('selected');
})

$('.addToCartBtn').on('click', function(e) {
    e.preventDefault();
    $('input[name="colorId"]').val($('.colorElement.selected').data('colorId'));
    $('input[name="sizeId"]').val($('#sizeSelect').val());
    $('input[name="quantity"]').val($('#quantityInput').val());
    $('#productCartForm').submit();
})