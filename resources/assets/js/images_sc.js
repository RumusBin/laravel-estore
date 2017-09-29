import * as $ from "jquery";

var page_name = $('#_page_name').val();


$(initImageHover);

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
});


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

    let itmId = $(this).children('input').val();


    imgReload(itmId);
    });

// send data to the server

function imgReload(itmId) {

// show form for check new image
    $('.form_inner').fadeIn(350);

    $('#inp_submit').on('click', function (e) {


        let form = $('#reload_img')[0];
        let formData = new FormData(form);
        formData.append('itmId', itmId);

        $.ajax({
            type: "POST",
            url: '/admin/'+page_name+'/imageReload',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function () {


                window.location.reload(true);

            },

            error: function (data) {
                console.log('error ' + data);
            }
        });

        $('.form_inner').fadeOut(350);
        e.preventDefault();
    });

}

//show selected image
function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#upl_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#img_new").change(function(){
    readURL(this);

});

$('.img_icon_delete').on('click', function (){
    let imgId = $(this).children('input').val();

    confirm('Вы действительно хотите удалить эту картинку???');
    $.ajax({
        type: "POST",
        url: '/admin/'+page_name+'/deleteImage/'+imgId,
        data: "",
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            alert('Сделано! '+response);
            window.location.reload(true);
        },
        error: function (data) {
            console.log('error ' + data);
        }
    });

});

$('#new-img-add').on('click',function (e) {
    let item_id = $(this).children('#item-img-id').val();

    $('.form_inner').fadeIn(350);

    $('#inp_submit').on('click', function (e) {

        let form = $('#reload_img')[0];
        let formData = new FormData(form);
        formData.append('product_id', item_id);


        $.ajax({
            type: "POST",
            url: '/admin/'+page_name+'/addNewImage',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                alert('Картинка '+response+' добавлена!');
                window.location.reload(true);
            },
            error: function (data) {
                console.log('error ' + data);
            }
        });

        $('.form_inner').fadeOut(350);
        e.preventDefault();
        })

});




