$(document).ready(function () {

    $('#btnGetOtp').click(function () {
        $.ajax({
            type: 'GET',
            url: '/api/otp/' + $('input#mob').val(),
            datatype: 'json',
            encode: true
        }).done(function (data) {
            alert(data['status']);
        });
    });

    $("#forgotForm").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "/api/forgot",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function (data) {
            alert(data['status']);
        });
    }));
});