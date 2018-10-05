$(document).ready(function () {

    $('#btngetimage').click(function () {
        var fromDate = $('#fromdatectrl').val();
        var todate = $('#todatectrl').val();
        var uid = $('input#usrid').val();
        $.ajax({
            type: 'GET',
            url: '/api/gallary/' + uid + '/' + fromDate + '/' + todate,
            datatype: 'json',
            encode: true,
        }).done(function (data) {
            var html = '';
            
            $.each(data, function (key, item) {                
                html = html + "<div class='column is-one-third'>";
                html = html + "<div class='card'>";
                html = html + "<div class='card-image'>";
                html = html + "<figure class='image is-4by3'>";
                html = html + "<img src='../visitimages/"+ item.visit_pic +"' alt='Placeholder image'>";
                html = html + "</figure>";
                html = html + "</div>";
                html = html + "<div class='card-content'>";
                html = html + "<div class='media'>";
                html = html + "<div class='media-left'>";
                html = html + "<figure class='image is-48x48'>";
                html = html + "<img src='../img/icds_logo.png' alt='Placeholder image'>";
                html = html + "</figure>";
                html = html + "</div>";
                html = html + "<div class='media-content'>";
                html = html + "<p class='title is-4'>"+ item.centre_name +"</p>";
                html = html + "<p class='subtitle is-6'>("+ item.centre_id +")</p>";
                html = html + "</div>";
                html = html + "</div>";
                html = html + "<div class='content'>";
                html = html + "<p >Visited by <b>"+ item.fullname +" ("+ item.designation +")</b> </p>";
                html = html + "<p>Visited on <time> "+ item.visit_date +" </time></p>";
                html = html + "</div>";
                html = html + "</div>";
                html = html + "</div>";
                html = html + "</div>";

            });
            $('#gallarycontainer').html(html);
        });
    });



});