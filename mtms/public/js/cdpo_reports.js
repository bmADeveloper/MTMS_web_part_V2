$(document).ready(function () {

    var selectedSupervisor = 0;

    $.ajax({
        type: 'GET',
        url: '/api/reports/subs/' + $('input#usrid').val(),
        datatype: 'json',
        encode: true
    }).done(function (data) {
        html = '<option value="">Select Reportee</option>';
        $.each(data, function (key, item) {
            html = html + '<option value="' + item.userid + '">' + item.fullname + '</option>'
        })
        $('#supervisorselect').html(html);
    });

    $("select.supervisorselect").change(function () {
        selectedSupervisor = $(".supervisorselect option:selected").val();
    });

    $('#SupervisorEfficiencyCalculator').click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();

        $.ajax({
            type: 'GET',
            url: '/api/efficiency/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var stat = data[0];
            $('#overalleff').text(stat['AVG_EFFI'] + "%");
            $('#percvisit').text(stat['PERC_VISIT'] + "%");
            $('#percopen').text(stat['PERC_OPEN'] + "%");
            $('#percsnpsrv').text(stat['PERC_SNP'] + "%");
            $('#percmssrv').text(stat['PERC_MS'] + "%");
            $('#percpse').text(stat['PERC_PSE'] + "%");
            $('#percweight').text(stat['PERC_WEIGHED'] + "%");
            $('#percmalmod').text(stat['PERC_MAL_MOD'] + "%");
            $('#percmalseve').text(stat['PERC_MAL_SEVERE'] + "%");
            $('#percmom').text(stat['PERC_MOM_MEET'] + "%");
            $('#percecce').text(stat['PERC_ECCE'] + "%");

            $('#totcentre').text(stat['TOT_CENT']);
            $('#viscentre').text(stat['TOT_VIS_CENT']);
            $('#opencentre').text(stat['TOT_OPEN_CENT']);
            $('#snpben').text(stat['TOT_SNP_BENEF']);
            $('#snpserv').text(stat['TOT_SNP_SERV']);
            $('#chld6m').text(stat['TOT_6M_6Y']);
            $('#msserve').text(stat['TOT_MS_SERV']);
            $('#chld3y').text(stat['TOT_3Y_6Y']);
            $('#chldpse').text(stat['TOT_PSE_P']);
            $('#chldblw5y').text(stat['TOT_BLW_5Y']);
            $('#chldweighed').text(stat['TOT_WEIGHED']);
            $('#malmod').text(stat['TOT_MOD']);
            $('#malseve').text(stat['TOT_SEVERE']);
            $('#mom').text(stat['TOT_MOM_MEET']);
            $('#regis').text(stat['CENT_LESS_REG']);
            $('#ecce').text(stat['CENT_ECCE']);

        });
    });

    $("#btnrptcentvis").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/visited/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Centres visited");

        });
    });

    $("#btnrptcentopen").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/openclose/' + selectedSupervisor + "/" + fromDate + "/" + todate + "/Yes",
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Centres found open");
        });
    });

    $("#btnrptcentclose").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/openclose/' + selectedSupervisor + "/" + fromDate + "/" + todate + "/No",
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Centres found close");
        });
    });

    $("#btnsnpreport").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/snp/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("SNP served");
        });
    });

    $("#btnsnacks").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/snacks/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Morning snacks provided");
        });
    });

    $("#btnpse").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/pse/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Present in PSE");
        });
    });

    $("#btnweighment").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/weighment/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Weighment report");
        });
    });

    $("#btnmalnur").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/malnourish/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Malnutration report");
        });
    });

    $("#btnnotvisited").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        $.ajax({
            type: 'GET',
            url: '/api/reports/notvisited/' + selectedSupervisor + "/" + fromDate + "/" + todate,
            datatype: 'string',
        }).done(function (data) {
            $('#tablebody').html(CreateTableView(data));
            $("#visitmodal").addClass("is-active");
            $(".modal-card-title").text("Centres not visited");
        });
    });

    $(".delete").click(function () {
        $(".modal").removeClass("is-active");
    });

    $("#exporttoexcel").click(function () {
        $("#data_table").table2excel({
            name: "Worksheet1",
            filename: "data.xls"
        });
    });


});


function CreateTableView(objArray, theme, enableHeader) {
    // set optional theme parameter
    if (theme === undefined) {
        theme = 'table'; //default theme
    }

    if (enableHeader === undefined) {
        enableHeader = true; //default enable headers
    }

    // If the returned data is an object do nothing, else try to parse
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;

    var str = '<table class="' + theme + '" id="data_table">';

    // table head
    if (enableHeader) {
        str += '<thead><tr>';
        for (var index in array[0]) {
            str += '<th scope="col">' + index + '</th>';
        }
        str += '</tr></thead>';
    }

    // table body
    str += '<tbody>';
    for (var i = 0; i < array.length; i++) {
        str += (i % 2 == 0) ? '<tr class="alt">' : '<tr>';
        for (var index in array[i]) {
            str += '<td>' + array[i][index] + '</td>';
        }
        str += '</tr>';
    }
    str += '</tbody>'
    str += '</table>';
    return str;
}

