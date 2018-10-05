$(document).ready(function(){
    $("#alert_super").click(function(){
        $.ajax({
            type: 'GET',
            url: '/api/send/mail',
            datatype: 'json',
            encode: true
        }).done(function (data) {
            alert(data['status']);
                        // $.each(data, function (key, item) {
                        //     alert(item.email);
                        // });
            });

    });

});