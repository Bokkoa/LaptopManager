
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
                    "data": "laptop.asset",
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

    //API
    $("form#search").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'https://reqres.in/api/users/'+ $("#employeenum").val(),
            dataType: 'json',
            success: function (data) {

                console.log(data);

                $("#employee").val(data.data.id);

                $("#name").val(data.data.first_name + ' ' + data.data.last_name);

                $("#uid").val(data.data.email);

                $("#employee-image").attr('src', data.data.avatar);
                $("#modal-image").attr('src', data.data.avatar);
            }
        });
      
    });

    //LAP SELECT
    $.ajax({
        type: 'GET',
        url: 'unused-laptops',
        datatype: 'json',
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


    //POST
    $("form#create").submit(function (e) {
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'api/asignation',
                data: {
                    employee_number: $("#employee").val(),
                    employee: $("#name").val(),
                    uid: $("#uid").val(),
                    laptop_id: $("#laptop").val(),
                },
                dataType: "JSON",
                success: function (response) {

                    if (response.status === 200) {

                        VanillaToasts.create({
                            title: 'Registro realizado',
                            text: `Usuario de vinculacion: ${response.data.employee}`,
                            type: 'success', // success, info, warning, error   / optional parameter
                            timeout: 5000 // hide after 5000ms, // optional paremter
                        });
                        refreshTable();
                        $('#create').trigger("reset");
                        $('#employee-image').attr('src', '');
                        $("#modal-image").attr('src', '');

                    }
                    else{
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
                  
                },
                error: function(error){
                    console.log(error);
                    VanillaToasts.create({
                        title: 'Algo falló en la petición',
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                }
            });


    });


    //UPDATE
    $("form#edit").submit(function (e) {
        e.preventDefault();
        let id = $("#modal-input-id").val();
        $.ajax({
            type: 'PUT',
            url: 'api/asignation/' + id,
            data: {
                id: id,
                employee: $("#modal-input-employee").val(),
                name: $("#modal-input-name").val(),
                uid: $("#modal-input-uid").val(),
                laptop: $("#modal-input-laptop").val(),
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.status === 200) {
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
                else if(response.status == 500){
                    $("#datatable").dataTable().fnClearTable();
                    VanillaToasts.create({
                        title: response.message,
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
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
            },
            error: function(error){

                VanillaToasts.create({
                    title: 'No existe el activo escrito',
                    text: ':(',
                    type: 'error', // success, info, warning, error   / optional parameter
                    timeout: 5000 // hide after 5000ms, // optional paremter
                });
                $('#edit-modal').modal('toggle');
              
            }
        });
    });


    $("form#delete").submit(function (e) {
        e.preventDefault();
        var asignationId =  $("#modal-input-id-delete").val();
        $.ajax({
            type: 'DELETE',
            url: 'api/asignation/'+ asignationId,
            dataType: 'JSON',
            success: function (response) {
                if (response.status === 200) {
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
                        title: 'Error al eliminar',
                        text: 'Asegurate de que el registro exista :(',
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