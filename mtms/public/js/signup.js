$(document).ready(function () {

    $('#btnGetOtp').click(function () {
        $.ajax({
            type: 'GET',
            url: '/api/otp/' + $('input#mob').val(),
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var stat = data[0];
            alert(data['status']);
        });
    });

    $("#regiForm").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "/api/signup",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function (data) {
            var stat = data[0];
            alert(data['status']);
        });
    }));
});