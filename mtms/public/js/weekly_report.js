$(document).ready(function(){

    $("#alert_super").click(function(){
        document.getElementById("alert_super").className = "button is-danger is-small is-fullwidth is-loading";
        $.ajax({
            type: 'GET',
            url: '/api/send/mail',
            datatype: 'json',
            encode: true
        }).done(function (data) {
            if(data['status']){
                alert(data['status']);
                document.getElementById("alert_super").className = "button is-success is-small is-fullwidth";
            }
                        // $.each(data, function (key, item) {
                        //     alert(item.email);
                        // });
            });
    });

});