$(initImageHover);

function initImageHover() {
    $('div.img-item').hover(imgTitleFadeIn, imgTitleFadeOut);
}

function imgTitleFadeIn() {
    $(this).find('.img_overlay').fadeIn(350);
}

function imgTitleFadeOut() {
    $(this).find('.img_overlay').fadeOut(350);
}

$('.img_icon_reload').on('click', function () {

    let imgId = $(this).children('input').val();


});


$('.img_icon_delete').on('click', function () {
    let imgVal = $(this).children('input').val();

});



