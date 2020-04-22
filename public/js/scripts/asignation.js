
function filltable() {
    try {
        $("#datatable").DataTable();
        $("#datatable").DataTable().destroy();

        table = $("#datatable").DataTable({
            "initComplete": function (settings, json) {
                $("#datatable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "ajax": {
                "url": "api/asignation",
                "dataType": "json",
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [
                {
                    "data": "id",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'id');
                    }
                },
                {
                    "data": "employee_number",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'name');
                    }
                },
                {
                    "data": "employee",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'employee');
                    }
                },
                {
                    "data": "uid",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'uid');
                    }
                },
                {
                    "data": "laptop.Lap_Asset",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'laptop');
                    }
                },
                {
                    "data": null,
                    "render": function (row) {
                        return `
             <td><div class="btn-group " role-group> <button type="button" id="edit-item" class="btn alert-info"><i class="fas fa-pen-square"></i></button>
                      <button type="button" id="delete-item" class="btn alert-danger"><i class="fas fa-eraser"></i></button></div></td></tr>`;

                    }
                }
            ],
            'createdRow': function (row, data, dataIndex) {
                $(row).addClass('data-row');
            },
            "deferRender": true,
        });


    } catch (e) {
        swal("Hubo un error al procesar los datos del servidor", "Por favor intenta más tarde", "error");
        console.log(e);
    }
}


function refreshTable() {
    var table = $("#datatable").DataTable();
    table.ajax.reload();
}




$(document).ready(function () {

    //SETUP AJAX
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
    });

    filltable();
    $("form#search").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'api/user',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                employeenum: $("#employeenum").val()
            },
            success: function (data) {

                $("#employee").val($("#employeenum").val());

                $("#name").val(data["FullName"]);

                $("#uid").val(data["WindowsUserId"]);

            }
        });


        $.ajax({
            type: 'GET',
            url: 'get-image',
            dataType: 'json',
            data: {
                // code: $("#employeenum").val()
            },
            success: function (data) {
                $("#employee-image").attr('src', 'data:image/jpeg;base64,' + data);
                $("#modal-image").attr('src', 'data:image/jpeg;base64,' + data);
            },
            error: function (response) {
                var img_temporary = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Imagen_no_disponible.svg/1024px-Imagen_no_disponible.svg.png"

                $("#employee-image").attr('src', img_temporary);
                $("#modal-image").attr('src', img_temporary);

                VanillaToasts.create({
                    title: 'Imagen',
                    text: 'No se encontro imagen',
                    type: 'error', // success, info, warning, error   / optional parameter
                    timeout: 3000 // hide after 5000ms, // optional parameter
                });
            }
        });
    });

    $.ajax({
        type: 'GET',
        url: 'api/laptop',
        datatype: 'json',
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function (data) {
            var strSelect = '';
            data = JSON.parse(data);
            $.each(data, function (v, k) {
                strSelect += '<option value="' + k.id + '">' + k.asset + '</option>';
            });
            // $("#laptop").append(strSelect);
            $("#laptop").html(strSelect);
            $("#laptop").chosen();
            $("#laptop").chosen().trigger('chosen:updated');

        }
    });


    $("form#create").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: 'checkforasignations',
            data: {
                "_token": "{{ csrf_token() }}",
                employee: $("#employee").val(),
                name: $("#name").val(),
                uid: $("#uid").val(),
                laptop: $("#laptop option:selected").val(),
            },
            dataType: "json",
            success: function (data) {

                var userLists = "";
                $.each(data, function (k, v) {
                    userLists += '<li class="list-group-item">Numero: ' + v.AS_Emp_Number + '  Nombre: ' + v.AS_Employee + '</li>';
                });
                $("#user-list").append(userLists);
                $("#modal-input-name-exists").val($("#employee").val());
                $("#modal-input-employee-exists").val($("#name").val());
                $("#modal-input-uid-exists").val($("#uid").val());
                $("#modal-input-laptop-exists").val($("#laptop option:selected").val());
                $("#asset-exists").text($("#laptop option:selected").text());
                $('#exists-modal').modal();

            },
            error: function () {
                $.ajax({
                    type: 'POST',
                    url: 'createasignation',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        employee: $("#employee").val(),
                        name: $("#name").val(),
                        uid: $("#uid").val(),
                        laptop: $("#laptop").val(),
                    },
                    success: function (data) {
                        if (data != "Fail") {

                            VanillaToasts.create({
                                title: 'Registro realizado',
                                text: ':)',
                                type: 'success', // success, info, warning, error   / optional parameter
                                timeout: 5000 // hide after 5000ms, // optional paremter
                            });
                            refreshTable();
                            $('#create').trigger("reset");
                            $('#employee-image').attr('src', '');
                            $("#modal-image").attr('src', '');

                        }
                        else {
                            $("#datatable").dataTable().fnClearTable();
                            VanillaToasts.create({
                                title: 'Activo ya asignado',
                                text: ':(',
                                type: 'error', // success, info, warning, error   / optional parameter
                                timeout: 5000 // hide after 5000ms, // optional paremter
                            });
                            refreshTable();
                            $('#create').trigger("reset");
                            $('#employee-image').attr('src', '');
                            $("#modal-image").attr('src', '');
                        }
                    }
                });
            }

        });

    });



    $("form#create2").submit(function (e) {
        e.preventDefault();

        // $("#modal-input-name-exists").val($("#name").val());
        //         $("#modal-input-employee-exists").val($("#employee").val());
        //         $("#modal-input-uid-exists").val($("#uid").val());
        //         $("#modal-input-laptop-exists").val($("#laptop option:selected").val());

        $.ajax({
            type: 'POST',
            url: 'createasignation',
            data: {
                "_token": "{{ csrf_token() }}",
                name: $("#modal-input-employee-exists").val(),
                employee: $("#modal-input-name-exists").val(),
                uid: $("#modal-input-uid-exists").val(),
                laptop: $("#modal-input-laptop-exists").val(),
            },
            success: function (data) {
                if (data != "Fail") {
                    $('#exists-modal').modal('toggle');
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: 'Registro realizado',
                        text: ':)',
                        type: 'success', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                    refreshTable();
                    $('#create').trigger("reset");
                    $('#employee-image').attr('src', '');
                    $("#modal-image").attr('src', '');

                }
                else {
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: 'Activo ya asignado',
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                    refreshTable();
                    $('#create').trigger("reset");
                    $('#employee-image').attr('src', '');
                    $("#modal-image").attr('src', '');
                }
            }
        });

    });


    $("form#edit").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'editasignation',
            data: {
                "_token": "{{ csrf_token() }}",
                id: $("#modal-input-id").val(),
                employee: $("#modal-input-employee").val(),
                name: $("#modal-input-name").val(),
                uid: $("#modal-input-uid").val(),
                laptop: $("#modal-input-laptop").val(),
            },
            success: function (data) {
                if (data != "Fail") {
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: 'Registro modificado',
                        text: ':)',
                        type: 'success', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                    refreshTable();
                    $('#create').trigger("reset");
                    $('#employee-image').attr('src', '');
                    $("#modal-image").attr('src', '');
                }
                else {
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: 'No existe el activo escrito',
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                    refreshTable();
                    $('#create').trigger("reset");
                    $('#employee-image').attr('src', '');
                    $("#modal-image").attr('src', '');
                }

                $('#edit-modal').modal('toggle');
            }
        });
    });


    $("form#delete").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'deleteasignation',
            data: {
                "_token": "{{ csrf_token() }}",
                id: $("#modal-input-id-delete").val(),
                employee: $("#modal-input-employee-delete").val(),
                name: $("#modal-input-name-delete").val(),
                uid: $("#modal-input-uid-delete").val(),
                laptop: $("#modal-input-laptop-delete").val(),
            },
            success: function (data) {
                if (data != "Fail") {
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: 'Registro eliminado',
                        text: ':)',
                        type: 'warning', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                    refreshTable();
                    $('#create').trigger("reset");
                    $('#employee-image').attr('src', '');
                    $("#modal-image").attr('src', '');
                }
                else {
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: 'Este letrero no deberia mostrarse',
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                    refreshTable();
                    $('#create').trigger("reset");
                    $('#employee-image').attr('src', '');
                    $("#modal-image").attr('src', '');
                }

                $('#delete-modal').modal('toggle');
            }
        });
    });

    $(document).on('click', "#edit-item", function () {
        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        $('#edit-modal').modal();
    })

    $(document).on('click', "#delete-item", function () {
        $(this).addClass('delete-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        $('#delete-modal').modal();
    })

    $(document).on('click', "#see-full", function () {
        $('#img-modal').modal();
    })



    // on modal show
    $('#edit-modal').on('show.bs.modal', function () {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".data-row");
        // console.log(row.children());

        // get the data
        var id = row.children('#id');
        var name = row.children('#name');
        var employee = row.children("#employee");
        var uid = row.children("#uid");
        var laptop = row.children("#laptop");

        // fill the data in the input fields
        $("#modal-input-id").val(id[0]['innerHTML']);
        $("#modal-input-name").val(name[0]['innerHTML']);
        $("#modal-input-employee").val(employee[0]['innerHTML']);
        $("#modal-input-uid").val(uid[0]['innerHTML']);
        $("#modal-input-laptop").val(laptop[0]['innerHTML']);

    })

    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function () {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })

    $('#delete-modal').on('show.bs.modal', function () {
        var el = $(".delete-item-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".data-row");
        // console.log(row.children('#uid')[0]['innerHTML']);

        // get the data
        var id = row.children('#id');
        var name = row.children('#name');
        var employee = row.children("#employee");
        var uid = row.children("#uid");
        var laptop = row.children("#laptop");

        // fill the data in the input fields
        $("#modal-input-id-delete").val(id[0]['innerHTML']);
        $("#modal-input-name-delete").val(name[0]['innerHTML']);
        $("#modal-input-employee-delete").val(employee[0]['innerHTML']);
        $("#modal-input-uid-delete").val(uid[0]['innerHTML']);
        $("#modal-input-laptop-delete").val(laptop[0]['innerHTML']);

    })

    // on modal hide
    $('#delete-modal').on('hide.bs.modal', function () {
        $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
        $("#delete-form").trigger("reset");
    })



});