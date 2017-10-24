

 //checkout form script
 //town shipping choosing
 $('#suggestion_ul').css('display', 'none');
    let df_town = $('#suggestion_ul').children('li').first().attr('text');
    $('#town_choose_local').val(df_town);

 $('#suggestion_ul').children('li').on('click', function () {
     $('#town_choose_local').val($(this).attr('text'));
     $('#suggestion_ul').slideUp();
 });

 $('#choose_t-i').on('click', function () {
     $('#town_choose_local').val('').focus();
     $('#suggestion_ul').slideUp();
     $('#hidden_town_text').show('slow');

     let availableTowns = [];
     let settings = {
         "async": true,
         "crossDomain": true,
         "url": "https://api.novaposhta.ua/v2.0/json/",
         "method": "POST",
         "headers": {
             "content-type": "application/json",

         },
         "processData": false,
         "data": "{" +
         "\r\n\"apiKey\": \"1488cdcdf2769a0983a0ca6b8da8b067\"," +
         "\r\n \"modelName\": \"Address\"," +
         "\r\n \"calledMethod\": \"getCities\"," +
         "\r\n \"methodProperties\": {" +

         "\r\n }" +
         "\r\n}"
     };

     $.ajax(settings).done(function (response) {

         $(response.data).each(function () {
             availableTowns.push($(this)[0].DescriptionRu);
         });
     });

     $("#town_choose_local").autocomplete({
         source: availableTowns
     });

 });

 $('#town_choose_local').on('click', function () {
         $('#suggestion_ul').slideDown();

 });


 $('#checkout_next').on('click', function () {

     $('#checkout_step_one').hide('slow');
     $('#checkout_step_two').show('slow');
     $('#checkout_heading').html('');
     $('#checkout_heading').text('Шаг 2');
     $('#checkout_next').hide('slow');
     $('#finish_checkout').show('slow');

     let cur_town = $('#town_choose_local').val();
    $('#cur_city').text(cur_town);


     $(function() {
         var settings = {
             "async": true,
             "crossDomain": true,
             "url": "https://api.novaposhta.ua/v2.0/json/",
             "method": "POST",
             "headers": {
                 "content-type": "application/json",

             },
             "processData": false,
             "data": '{\r\n\"apiKey\": \"\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"getWarehouses\",\r\n \"methodProperties\": {\r\n \"CityName\": \"'+ cur_town +' \"}\r\n}'
         };

         $.ajax(settings).done(function (response) {
           $(response.data).each(function () {
                    console.log($(this)[0])
                   $('#warhouse_list').append($("<option>").attr('value',$(this)[0].DescriptionRu).text($(this)[0].DescriptionRu));
           }

           );

         });
     });

 });

 $('#finish_checkout').on('click', function () {
     $('#checkout_step_two').hide('slow');
     $('#finish_checkout').hide('slow');
     $('#checkout_step_two').hide('slow');
     $('#checkout_finishd_block').show('slow');
     $('#checkout_heading').html('');
     $('#checkout_heading').text('Заказ оформлен.');
     $('.checkout-options').hide('slow');
     $('.register-req').hide('slow');
     $('#checkout_form').submit();

 });




 // connect to NovaPoshta API and get list of cities


    // console.log(df_town);
    // $(this).append(df_town);




 // $("ul").on("click", ".init", function() {
 //     $(this).closest("ul").children('li:not(.init)').slideDown();
 // });
 //
 // var allOptions = $("ul").children('li:not(.init)');
 // $("ul").on("click", "li:not(.init)", function() {
 //     allOptions.removeClass('selected');
 //     $(this).addClass('selected');
 //     $("ul").children('.init').html($(this).html());
 //     allOptions.slideUp();
 // });
 //
 //
 // $("#submit").click(function() {
 //     alert("The selected Value is "+ $("ul").find(".selected").data("value"));
 // });