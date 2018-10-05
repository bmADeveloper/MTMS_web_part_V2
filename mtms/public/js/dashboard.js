$(document).ready(function () {


    $('#synopsistable').DataTable({
        "paging": false,
        "ordering": false,
        "info": false,
        "scrollY": "300px",
        "scrollX": true,
        "scrollCollapse": true,
        "searching": false
    });

    $('#recentVisitTable').DataTable({
        "paging": false,
        "ordering": false,
        "info": false,
        "scrollY": "400px",
        "scrollX": true,
        "scrollCollapse": true,
        "searching": false,
    });

    $.ajax({
        type: 'GET',
        url: '/api/user/' + $('input#usrid').val(),
        datatype: 'json',
        encode: true
    }).done(function (data) {
        var profile = data[0];
        $('#welcomemsg').text("Welcome " + profile['fullname'] + "!");
    });

    var curDate = new Date();
    var _day = $.format.date(curDate, "yyyy-MM-dd");

    $('#subtitlecentrevisit').text($.format.date(curDate, "dd/MM/yyyy") + " to " + $.format.date(curDate, "dd/MM/yyyy"));
    $('#subtitlecentreopen').text($.format.date(curDate, "dd/MM/yyyy") + " to " + $.format.date(curDate, "dd/MM/yyyy"));
    $('#subtitleefficiency').text($.format.date(curDate, "dd/MM/yyyy") + " to " + $.format.date(curDate, "dd/MM/yyyy"));

    utilfunc.getdash($('input#usrid').val(), _day, _day);
    utilfunc.getcdpo($('input#usrid').val(), _day, _day);
    utilfunc.getrecentvisit($('input#usrid').val(), _day, _day);
    utilfunc.getvisitfrequency($('input#usrid').val(), _day, _day);
    utilfunc.getmalnutsceane($('input#usrid').val(), _day, _day);
    utilfunc.getsnpservefrequency($('input#usrid').val(), _day, _day);

    $("#refresh_dashboard").click(function () {
        var fromDate = $("#fromdatectrl").val();
        var todate = $("#todatectrl").val();
        utilfunc.getdash($('input#usrid').val(), fromDate, todate);
        utilfunc.getcdpo($('input#usrid').val(), fromDate, todate);
        utilfunc.getrecentvisit($('input#usrid').val(), fromDate, todate);
        utilfunc.getvisitfrequency($('input#usrid').val(), fromDate, todate);
        utilfunc.getmalnutsceane($('input#usrid').val(), fromDate, todate);
        utilfunc.getsnpservefrequency($('input#usrid').val(), fromDate, todate);
        $('#subtitlecentrevisit').text($.format.date(new Date(fromDate), "dd/MM/yyyy") + " to " + $.format.date(new Date(todate), "dd/MM/yyyy"));
        $('#subtitlecentreopen').text($.format.date(new Date(fromDate), "dd/MM/yyyy") + " to " + $.format.date(new Date(todate), "dd/MM/yyyy"));
        $('#subtitleefficiency').text($.format.date(new Date(fromDate), "dd/MM/yyyy") + " to " + $.format.date(new Date(todate), "dd/MM/yyyy"));
    });

    $("#summaryButton").click(function(){
        
        $.ajax({
            type: 'GET',
            url: '/api/reports/summary/' + $("#fromdatectrl").val() + "/" + $("#todatectrl").val(),
            datatype: 'json',
            encode: true
        }).done(function (data) {
            $("#dvjson").excelexportjs({
                containerid: "dvjson",
                datatype: 'json',
                dataset: data,
                columns: getColumns(data)    
            });
        });
    });
});

utilfunc = {
    getdash: function (id, fromdate, todate) {
        $.ajax({
            type: 'GET',
            url: '/api/dashboard/' + id + "/" + fromdate + "/" + todate,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var stat = data[0];
            $('#CardNumTotSup').text(stat['blkTotSup'] + " Supervisors.");
            $('#CardNumTotCent').text(stat['BlkTotCent'] + " Centre(s).");
            $('#CardNumCentOpen').text(stat['BlkTotOpen'] + " Centre(s).");
            $('#CardNumCentVis').text(stat['BlkTotVis'] + " Centre(s).");

        });
    },
    getcdpo: function (id, fromdate, todate) {
        $.ajax({
            type: 'GET',
            url: '/api/efficiency/' + id + "/" + fromdate + "/" + todate,
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
    },
    getrecentvisit: function (id, fromdate, todate) {
        $.ajax({
            type: 'GET',
            url: '/api/visit/recent/' + id + "/" + fromdate + "/" + todate,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var html = ""
            $.each(data, function (key, item) {
                html = html + "<tr>";
                html = html + "<td>" + item.centreid + "</td>";
                html = html + "<td>" + item.centre_name + "</td>";
                html = html + "<td>" + $.format.date(new Date(item.visit_date), "dd/MM/yyyy") + "</td>";
                html = html + "<td style='align:center;'>" + item.benef_total + "</td>";
                html = html + "<td style='align:center;'>" + item.benef_serve + "</td>";
                html = html + "<td style='align:center;'>" + item.chld_7m_6y_tot + "</td>";
                html = html + "<td style='align:center;'>" + item.chld_7m_6y_Mor_Snacks + "</td>";
                html = html + "</tr>";

            });
            $('#recentvistbody').html(html);
        });
    },
    getvisitfrequency: function (id, fromdate, todate) {
        $.ajax({
            type: 'GET',
            url: '/api/visit/frequency/' + id + "/" + fromdate + "/" + todate,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var label_array = [];
            var value_array = [];
            $.each(data, function (key, item) {
                label_array.push(item.label);
                value_array.push(item.visc);
            });
            var ctx = document.getElementById("visitChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: label_array,
                    datasets: [{
                        label: 'No. of Visits',
                        data: value_array,
                        backgroundColor: [
                            'rgba(90, 191, 22, 0.2)'
                        ],
                        borderColor: [
                            'rgba(51,108,14,1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    },
    getmalnutsceane: function (id, fromdate, todate) {
        $.ajax({
            type: 'GET',
            url: '/api/efficiency/' + id + "/" + fromdate + "/" + todate,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var stat = data[0];
            var value_array = [];
            $.each(data, function (key, item) {
                var stat = data[0];
                value_array.push((parseFloat(stat['TOT_WEIGHED']) - (parseFloat(stat['TOT_MOD']) + parseFloat(stat['TOT_SEVERE']))));
                value_array.push(stat['TOT_MOD']);
                value_array.push(stat['TOT_SEVERE']);
            });
            var ctx1 = document.getElementById("visitChart1").getContext("2d");
            var myChart1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ["Normal", "Moderate", "Severe"],
                    datasets: [{
                        label: '# of Votes',
                        data: value_array,
                        backgroundColor: [
                            'rgba(63, 191, 63, 0.5)',
                            'rgba(240, 247, 34, 0.5)',
                            'rgba(250, 137, 45, 0.5)'
                        ],
                        borderColor: [
                            'rgba(63, 191, 63, 0.5)',
                            'rgba(240, 127, 34, 0.5)',
                            'rgba(240, 34, 44, 0.5)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    },
    getsnpservefrequency: function (id, fromdate, todate) {
        $.ajax({
            type: 'GET',
            url: '/api/snp/frequency/' + id + "/" + fromdate + "/" + todate,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            var label_array = [];
            var value_array = [];
            var bg_array = [];
            var br_array = [];
            $.each(data, function (key, item) {
                label_array.push(item.label);
                value_array.push(item.visc);
                bg_array.push('rgba(90, 191, 22, 0.5)');
                br_array.push('rgba(51,108,14,1)');
            });
            var ctx = document.getElementById("visitChart2").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label_array,
                    datasets: [{
                        label: 'No. of Beneficiaries',
                        data: value_array,
                        backgroundColor:bg_array ,
                        borderColor: br_array,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

     },

};