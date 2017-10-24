// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });


$('#nova_poshta').on('click', function (e) {
    e.preventDefault();
    getTowns()
});

    // connect to NovaPoshta API and get list of cities
    function getTowns() {
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
             console.log($(this)[0].Ref);
             console.log($(this)[0].Description);
         });
     });
}



// $(function() {
//     var settings = {
//         "async": true,
//         "crossDomain": true,
//         "url": "https://api.novaposhta.ua/v2.0/json/",
//         "method": "POST",
//         "headers": {
//             "content-type": "application/json",
//
//         },
//         "processData": false,
//         "data": "{" +
//         "\r\n\"apiKey\": \"1488cdcdf2769a0983a0ca6b8da8b067\"," +
//         "\r\n \"modelName\": \"Address\"," +
//         "\r\n \"calledMethod\": \"getCities\"," +
//         "\r\n \"methodProperties\": {" +
//
//         "\r\n }" +
//         "\r\n}"
//     };
//
//     $.ajax({
//         async: true,
//         crossDomain: true,
//         url: "https://api.novaposhta.ua/v2.0/json/",
//
//     });
//
//     $.ajax(settings).done(function (response) {
//
//         $('#citys_NewPost').append('<select name="nameCitys">' +
//             '<option>')
//
//         let sel = $('<select>').appendTo('#city_NewPost');
//         $(response.data).each(function() {
//             sel.append($("<option>").attr('value',$(this)[0].Ref).text($(this)[0].Description));
//         });
//     });
// });
