$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '/api/settings/blocks',
        datatype: 'json',
        encode: true
    }).done(function (data) {
        html = '<option value="">Select Block...</option>';
        $.each(data, function (key, item) {
            html = html + '<option value="' + item.blockid + '">' + item.block_name + '</option>'
        })
        $('#selectBlocks').html(html);
    });

    $("#selectBlocks").change(function () {
        selectedblock = $("#selectBlocks option:selected").val();
        $.ajax({
            type: 'GET',
            url: '/api/settings/project/' + selectedblock,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select Project...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.project_id + '">' + item.project_name + '</option>'
            })
            $('#selectProjects').html(html);
        });

        //this section will preload the data on modal
        $.ajax({
            type: 'GET',
            url: '/api/settings/blocks',
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select Block...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.blockid + '">' + item.block_name + '</option>'
            })
            $('#modalSelectBlock').html(html);
        });
    });
    $('#getTable').click(function () {
        selectedblock = $("#selectBlocks option:selected").val();
        selectedproject = $("#selectProjects option:selected").val();
        $.ajax({
            type: 'GET',
            url: '/api/settings/table/' + selectedblock + '/' + selectedproject,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            $('#centreDetailTable').html(CreateTableView(data));
        });
    });

    $(".delete").click(function () {
        $(".modal").removeClass("is-active");
    });

    $("#modalSelectBlock").change(function () {
        ModalSelectedBlock = $("#modalSelectBlock option:selected").val();

        //loading project for selection.
        $.ajax({
            type: 'GET',
            url: '/api/settings/project/' + ModalSelectedBlock,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select project...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.project_id + '">' + item.project_name + '(' + item.project_id + ')' + '</option>'
            })
            $('#modalSelectproj').html(html);
        });
        //loading GP for selection.
        $.ajax({
            type: 'GET',
            url: '/api/modal/gp/' + ModalSelectedBlock,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select GP...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.gpid + '">' + item.GP_name + '</option>'
            })
            $('#modalSelectGP').html(html);
        });

        //loading sector for selection.
        $.ajax({
            type: 'GET',
            url: '/api/modal/sector/' + ModalSelectedBlock,
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select Sector...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.sectorid + '">' + item.sector_name + ' (' + item.sectorid + ')' + '</option>'
            })
            $('#modalSelectsector').html(html);
        });

        //loading supervisor for selection.
        $.ajax({
            type: 'GET',
            url: '/api/modal/supervisor',
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select Supervisor...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.userid + '">' + item.fullname + '</option>'
            })
            $('#modalselectsuper').html(html);
        });

        //loading CDPO for selection.
        $.ajax({
            type: 'GET',
            url: '/api/modal/cdpo',
            datatype: 'json',
            encode: true
        }).done(function (data) {
            html = '<option value="">Select CDPO...</option>';
            $.each(data, function (key, item) {
                html = html + '<option value="' + item.userid + '">' + item.fullname + '</option>'
            })
            $('#modalselectcdpo').html(html);
        });
    });

    $("#btnSubmit").click(function () {
        var centcode = $('#centCode').text();
        var bcode = $("#modalSelectBlock option:selected").val();
        var prjcode = $("#modalSelectproj option:selected").val();
        var seccode = $("#modalSelectsector option:selected").val();
        var supcode = $("#modalselectsuper option:selected").val();
        var cdpocode = $("#modalselectcdpo option:selected").val();

        $.post("/api/modal/update", {
            centcode: centcode,
            bcode: bcode,
            prjcode: prjcode,
            seccode: seccode,
            supcode: supcode,
            cdpocode: cdpocode
        }).done(function (data) {
            $(".modal").removeClass("is-active");
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
            if (index == 'centre_id') {
                str += '<td><a href="#" onclick="showModal(' + array[i][index] + ')">' + array[i][index] + '</a></td>';
            } else {
                str += '<td>' + array[i][index] + '</td>';
            }

        }
        str += '</tr>';
    }
    str += '</tbody>'
    str += '</table>';
    return str;
}

function showModal(c_code) {
    $('#centCode').text(c_code);
    $.ajax({
        type: 'GET',
        url: '/api/modal/centrename/' + c_code,
        datatype: 'json',
        encode: true
    }).done(function (data) {
        $('#centName').text(data[0].centre_name);
    });
    $("#CentreModal").addClass("is-active");
}

