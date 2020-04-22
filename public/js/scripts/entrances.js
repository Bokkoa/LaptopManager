function filltable() {
  var table = $("#datatable").DataTable();
  table.ajax.reload();

  //   (k.ENTR_Location == 1) ? strTable += '<td id="location">Tijera</td>' : strTable += '<td id="location">Periférico</td>';
  //   strTable+= '<td><div class="btn-group " role-group> <button type="button" id="edit-item" class="btn alert-info"><i class="fas fa-pen-square"></i></button>'+
  //   '<button type="button" id="delete-item" class="btn alert-danger"><i class="fas fa-eraser"></i></button></div></td></tr>';
  // });  
}

function initTable() {
  try {
    $("#datatable").DataTable();
    $("#datatable").DataTable().destroy();

    table = $("#datatable").DataTable({
      "initComplete": function (settings, json) {
        $("#datatable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
      },
      "ajax": {
        "url": "api/entrance",
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
          "data": "name",
          "createdCell": function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'name');
          }
        },
        {
          "data": "hostname",
          "createdCell": function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'asset');
          }
        },
        {
          "data": "location",
          "createdCell": function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'location');
            switch ($(td).text()) {
              case '1':
                $(td).text('Norte');
                break;
              case '2':
                $(td).text('Sur');
                break;
              case '3':
                $(td).text('Este');
                break;
              case '4':
                $(td).text('Oeste');
                break;
              default:
                $(td).text('Indefinido');
                break;

            }

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
$(document).ready(function () {
  initTable();


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
    //INSERT
    $.ajax({
      type: 'POST',
      url: 'api/entrance',
      data: {
        name: $("#name").val(),
        asset: $("#asset").val(),
        location: $("#location  option:selected").val(),
      },
      success: function (data) {
        if (data != "Fail") {
          $("#datatable").dataTable().fnClearTable();
          VanillaToasts.create({
            title: 'Registro realizado',
            text: ':)',
            type: 'success', // success, info, warning, error   / optional parameter
            timeout: 5000 // hide after 5000ms, // optional paremter
          });
          filltable();
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
          filltable();
          $('#create').trigger("reset");
          $('#employee-image').attr('src', '');
          $("#modal-image").attr('src', '');
        }
      }
    });
  });


  $("form#edit").submit(function (e) {
    e.preventDefault();
    let id = $("#modal-input-id").val();
    //UPDATE
    $.ajax({
      url: 'api/entrance/' + id,
      type: 'PUT',
      data: {
        id: id,
        name: $("#modal-input-name").val(),
        asset: $("#modal-input-asset").val(),
        location: $("#modal-input-location").val(),
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
          filltable();
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
          filltable();
          $('#create').trigger("reset");
          $('#employee-image').attr('src', '');
          $("#modal-image").attr('src', '');
        }

        $('#edit-modal').modal('toggle');
      }
    });
  });


  $("form#delete").submit(function (e) {
    let id = $("#modal-input-id-delete").val();
    e.preventDefault();
    $.ajax({
      type: 'DELETE',
      url: 'api/entrance/' + id,
      data: {
        id: id,
        name: $("#modal-input-name-delete").val(),
        asset: $("#modal-input-asset-delete").val(),
        location: $("#modal-input-location-delete").val(),
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
          filltable();
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
          filltable();
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


  // on modal show
  $('#edit-modal').on('show.bs.modal', function () {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
    var row = el.closest(".data-row");
    // console.log(row.children());

    // get the data
    var id = row.children('#id');
    var name = row.children('#name');
    var asset = row.children("#asset");
    var location = row.children("#location");
    var r = (location[0]['innerHTML'] == "Tijera") ? 1 : 2;
    // fill the data in the input fields
    $("#modal-input-id").val(id[0]['innerHTML']);
    $("#modal-input-name").val(name[0]['innerHTML']);
    $("#modal-input-asset").val(asset[0]['innerHTML']);
    $("#modal-input-location").val(r);

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
    var asset = row.children("#asset");
    var location = row.children("#location");

    // fill the data in the input fields
    $("#modal-input-id-delete").val(id[0]['innerHTML']);
    $("#modal-input-name-delete").val(name[0]['innerHTML']);
    $("#modal-input-asset-delete").val(asset[0]['innerHTML']);
    $("#modal-input-location-delete").val(location[0]['innerHTML']);

  })

  // on modal hide
  $('#delete-modal').on('hide.bs.modal', function () {
    $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
    $("#delete-form").trigger("reset");
  })



});