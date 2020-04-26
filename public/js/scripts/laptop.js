'use strict'
function loadTable() {
    try {
        $("#datatable").DataTable();
        $("#datatable").DataTable().destroy();

        let table = $("#datatable").DataTable({
            "initComplete": function (settings, json) {
                $("#datatable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "ajax": {
                "url": "api/laptop",
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
                    "data": "asset",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'asset');
                    }
                },
                {
                    "data": "owner",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'owner');
                    }
                },
                {
                    "data": "created_at",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'cdate');
                    }
                },
                {
                    "data": "creation_user",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).attr('id', 'cuser');
                    }
                },
                {
                    "data": null,
                    "render": function (row) {
                        return `<button type="button" class="btn btn-info btn-sm" data-toggle="modal" id="edit-item">
                          <i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" id="delete-item">
                          <i class="fa fa-trash"></i></button></div></td></tr>`;

                    }
                }
            ],
            'createdRow': function (row, data, dataIndex) {
                $(row).addClass('data-row');
            },
            "deferRender": true,
        });


    } catch (e) {
        console.log(e);
        swal("Hubo un error al procesar los datos del servidor", "Por favor intenta más tarde", "error");

    }
}

function refreshTable() {
    let table = $("#datatable").DataTable();
    table.ajax.reload();
}

$(document).ready(function () {
    loadTable();
    //SETUP AJAX
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
    });

    $("form#create").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'api/laptop',
            data: {
                asset: $("#asset").val(),
                owner: $("#owner").val(),
            },
            success: function (data) {
                if (data != "fail") {
                    $('#create').trigger("reset");
                    VanillaToasts.create({
                        title: 'Registro realizado',
                        text: ':)',
                        type: 'success', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });

                    refreshTable();
                }
                else {
                    VanillaToasts.create({
                        title: 'Registro repetido',
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                }

            },
            error: function(e){
                VanillaToasts.create({
                    title: 'Error en la peticion',
                    text: ':(',
                    type: 'error', // success, info, warning, error   / optional parameter
                    timeout: 5000 // hide after 5000ms, // optional paremter
                });
            }
        });
    });


    $("form#delete").submit(function (e) {
        e.preventDefault();
        let id = $("#modal-input-id-delete").val();
        $.ajax({
            type: 'DELETE',
            url: 'api/laptop/'+id,
            data: $("form#delete").serialize(),
            success: function (data) {
                VanillaToasts.create({
                    title: 'Registro eliminado',
                    text: ':)',
                    type: 'success', // success, info, warning, error   / optional parameter
                    timeout: 5000 // hide after 5000ms, // optional paremter
                });

                refreshTable();
                $('#delete-modal').modal('toggle');
            },
            error: function(e){
                VanillaToasts.create({
                    title: 'Error en la peticion',
                    text: ':(',
                    type: 'error', // success, info, warning, error   / optional parameter
                    timeout: 5000 // hide after 5000ms, // optional paremter
                });
            }
        });
    });

    $("form#edit").submit(function (e) {
        e.preventDefault();
        let id = $("#modal-input-id").val();

        $('#edit-modal').modal('toggle');
        $.ajax({
            type: 'PUT',
            url: 'api/laptop/'+id,
            data: $("form#edit").serialize(),
            success: function (data) {
                if (data != "fail") {
                    VanillaToasts.create({
                        title: 'Registro modificado',
                        text: ':)',
                        type: 'success', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });

                    refreshTable();
                }
                else {
                    VanillaToasts.create({
                        title: 'Registro repetido',
                        text: ':(',
                        type: 'error', // success, info, warning, error   / optional parameter
                        timeout: 5000 // hide after 5000ms, // optional paremter
                    });
                }
            },
            error: function(e){
                VanillaToasts.create({
                    title: 'Error en la peticion',
                    text: ':(',
                    type: 'error', // success, info, warning, error   / optional parameter
                    timeout: 5000 // hide after 5000ms, // optional paremter
                });
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



    // on modal show
    $('#edit-modal').on('show.bs.modal', function () {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".data-row");
        // console.log(row.children());

        // get the data
        var id = row.children("#id");
        var asset = row.children('#asset');
        var owner = row.children('#owner');
        var cuser = row.children("#cuser");
        var cdate = row.children("#cdate");

        // fill the data in the input fields

        $("#modal-input-id").val(id[0]['innerHTML']);
        $("#modal-input-asset").val(asset[0]['innerHTML']);
        $("#modal-input-owner").val(owner[0]['innerHTML']);
        $("#modal-input-cuser").val(cuser[0]['innerHTML']);
        $("#modal-input-cdate").val(cdate[0]['innerHTML']);

    });

    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function () {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    });

    // on modal show
    $('#linked-modal').on('show.bs.modal', function () {




    });

    $('#linked-modal').on('hide.bs.modal', function () {
        $("#users").empty();
    });


    $('#delete-modal').on('show.bs.modal', function () {
        var el = $(".delete-item-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".data-row");
        // console.log(row.children('#uid')[0]['innerHTML']);

        // get the data
        var id = row.children("#id");
        var asset = row.children('#asset');
        var owner = row.children('#owner');
        var cuser = row.children("#cuser");
        var cdate = row.children("#cdate");

        // fill the data in the input fields
        $("#modal-input-id-delete").val(id[0]['innerHTML']);
        $("#modal-input-asset-delete").val(asset[0]['innerHTML']);
        $("#modal-input-owner-delete").val(owner[0]['innerHTML']);
        $("#modal-input-cuser-delete").val(cuser[0]['innerHTML']);
        $("#modal-input-cdate-delete").val(cdate[0]['innerHTML']);

    })

    // on modal hide
    $('#delete-modal').on('hide.bs.modal', function () {
        $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked');


        // get the data
        var id = $("#modal-input-id-delete").val();
        var asset = $('#modal-input-asset-delete').val();
        var cuser = $("#modal-input-cuser-delete").val();
        var cdate = $("#modal-input-cdate-delete").val();

        // fill the data in the input fields

        $("#modal-input-id-delete-2").val(id);
        $("#modal-input-asset-delete-2").val(asset);
        $("#modal-input-cuser-delete-2").val(cuser);
        $("#modal-input-cdate-delete-2").val(cdate);

        $("#delete-form").trigger("reset");

    })



});