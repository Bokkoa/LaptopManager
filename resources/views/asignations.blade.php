@extends('partials\master')

@section('content')
<main class="main">
  <div class="container-fluid">


  <br>
     <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Buscar</div>
          <form id="search" action="lookup" method="post" style="padding:5px;">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="employeenum">Numero de empleado:</label>
                  <input type="number" name="employeenum" id="employeenum" class="form-control">
                </div>
              </div>
             
            </div>
        
            
          <button type="submit" class="btn btn-laptop">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">

    <br>
     <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Asignaciones</div>
          <form id="create" action="createasignation" method="post" style="padding:5px;">
            @csrf
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label for="employee">Empleado:</label>
                  <input type="text" name="employee" id="employee" class="form-control">
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="name">Nombre:</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="uid">UID:</label>
                  <input type="text" name="uid" id="uid" class="form-control">
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="asset">Activo:</label>
                  <select name="laptop" id="laptop" class="form-control"></select>
                </div>
              </div>
             
            </div>
        
            
          <button type="submit" class="btn btn-laptop">Crear</button>
          <br>
          <br>
          <div class="container-fluid">
            <hr class="my-hr">
          </div>
        <div class="img-section row justify-content-center rounded-lg" >
          <div class="shadow rounded-lg"  style=" width: 250px;">
          <div class="hovereffect rounded-lg" style=" width: 250px;">
            <img id="employee-image" src="" class="image-responsive rounded-lg border-warning"  >
            <div class="overlay" style=" width: 250px;">
              <h2> <a id="see-full" class="btn btn-outline-warning"> <i class="fas fa-eye"></i> </a></h2>
              <p>Ver Completo</p>
            </div>
          </div>
          </div>
        </div>

        </form>
      </div>
    </div>
  </div>
</div>

   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Asignaciones</div>
          <div class="col-12">
          <div class="table-responsive">
            <table id="datatable" class="table table-hover table-bordered table-sm text-center ">
              <thead class="thead-light">
                <tr>
                  <th><strong>#</strong></th>
                  <th><strong>Numero</strong></th>
                  <th><strong>Nombre</strong></th>
                  <th><strong>UID</strong></th>
                  <th><strong>Activo</strong></th>
                  <th><strong>Acciones</strong></th>
                </tr>
              </thead>
              <tbody id="body-datatable">
            
              </tbody>
            </table>
          </div>
        </div>
       </div>
      </div>
    </div>
   </div>

</div>

<div class="modal fade " id="img-modal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" align="center"><b>Imagen</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="modal-image" class="img-thumbnail" src="" alt="">
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="edit-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" align="center"><b>Modificar asignación</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit" role="form" action="editasignation" method="post" id="edit">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="box-body">
              <div class="form-group"> 
            <input type="hidden" name="id" id="modal-input-id">
                <label for="modal-input-name">Número de empleado</label>
                <input type="text" class="form-control" id="modal-input-name" name="name" readonly>
              </div>
              <div class="form-group">
                <label for="modal-input-employee">Nombre</label>
                <input type="text" class="form-control" id="modal-input-employee" name="employee" required>
              </div>
              <div class="form-group">
                <label for="modal-input-uid">UID</label>
                <input type="text" class="form-control" id="modal-input-uid" name="uid" required>
              </div>
              <div class="form-group">
                <label for="modal-input-laptop">Activo de laptop</label>
                <input type="text" class="form-control" id="modal-input-laptop" name="laptop" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete-modal">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" align="center"><b>Eliminar asignacion</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form id="delete" role="form" action="deleteasignation" method="post" id="delete">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="box-body">
          <div class="form-group">
            <input type="hidden" name="id" id="modal-input-id-delete">
            <label for="modal-input-name-delete">Numero de empleado</label>
            <input type="text" class="form-control" id="modal-input-name-delete" name="name" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-employee-delete">Nombre</label>
            <input type="text" class="form-control" id="modal-input-employee-delete" name="employee" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-uid-delete">UID</label>
            <input type="text" class="form-control" id="modal-input-uid-delete" name="uid" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-laptop-delete">Activo de laptop</label>
            <input type="text" class="form-control" id="modal-input-laptop-delete" name="laptop" readonly>
          </div>
        </div>
        <label><strong>¿Estás seguro de que deseas eliminar este registro?</strong></label>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger">Borrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<!-- EXISTS OTHER USERS MODAL  -->

<div class="modal fade" id="exists-modal">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" align="center"><b>Activos multiusuario</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="alert alert-warning">
      El sistema tiene vinculado al activo <span> <label id="asset-exists"></label> </span> con los siguientes usuarios: </div>
      
      <!-- USERS LIST -->
      <ul id="user-list" class="list-group">
      </ul>

      <hr>
      
      <div class="alert alert-info">¿Desea vincular el siguiente usuario a un activo como multiusuario?</div>
      <form id="create2" role="form" action="createasignation" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="box-body">
          <div class="form-group">
            <input type="hidden" name="id" id="modal-input-id-exists">
            <label for="modal-input-name-exists">Numero de empleado</label>
            <input type="text" class="form-control form-control-sm" id="modal-input-name-exists" name="name" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-employee-exists">Nombre</label>
            <input type="text" class="form-control form-control-sm" id="modal-input-employee-exists" name="employee" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-uid-exists">UID</label>
            <input type="text" class="form-control form-control-sm" id="modal-input-uid-exists" name="uid" readonly>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control form-control-sm" id="modal-input-laptop-exists" name="laptop" readonly>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Asignar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


</main>
<script type="text/javascript">

function filltable()
{
  try {
    $("#datatable").DataTable();
    $("#datatable").DataTable().destroy();

    table = $("#datatable").DataTable({
      "initComplete": function (settings, json) {
        $("#datatable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
      },
      "ajax": {
        "url": "getasignations",
        "dataType": "json",
         "type": "GET",
        "dataSrc" : ""
      },
      "columns": [
        {
          "data": "AS_ID",
          "createdCell":  function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'id');
          }
        },
         {
          "data": "AS_Emp_Number",
          "createdCell":  function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'name');
          }
        },
         {
          "data": "AS_Employee",
          "createdCell":  function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'employee');
          }
        },
         {
          "data": "AS_UID",
          "createdCell":  function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'uid');
          }
        },
        {
          "data": "laptop.Lap_Asset",
          "createdCell":  function (td, cellData, rowData, row, col) {
            $(td).attr('id', 'laptop');
          }
        },
        {
          "data": null,
         "render": function(row) {
             return  `
             <td><div class="btn-group " role-group> <button type="button" id="edit-item" class="btn alert-info"><i class="fas fa-pen-square"></i></button>
                      <button type="button" id="delete-item" class="btn alert-danger"><i class="fas fa-eraser"></i></button></div></td></tr>`; 
          
         }
       }
      ],
      'createdRow': function( row, data, dataIndex ) {
        $(row).addClass('data-row');
      },
      "deferRender": true,
    });

  
  } catch (e) {
    swal("Hubo un error al procesar los datos del servidor", "Por favor intenta más tarde", "error");
    console.log(e);
  }
}
function refreshTable(){
  var table = $("#datatable").DataTable();
  table.ajax.reload();
}
$( document ).ready(function() {
  filltable();
  $("form#search").submit(function(e){
          e.preventDefault();
          $.ajax({
              type: 'GET',
              url: 'lookup',
              dataType: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
                employeenum: $("#employeenum").val()
              },
              success: function(data) {
               
                  $("#employee").val($("#employeenum").val());
              
                  $("#name").val(data["FullName"]);
                
                  $("#uid").val(data["WindowsUserId"]);
                  
              }
          });


          $.ajax({
              type: 'GET',
              url: 'getimage',
              dataType: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
                code: $("#employeenum").val()
              },
              success: function(data) {
                $("#employee-image").attr('src', 'data:image/jpeg;base64,' + data);
                $("#modal-image").attr('src', 'data:image/jpeg;base64,' + data);
              },
              error: function(response)
              {
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
              url: 'getlaptops',
              datatype: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                var strSelect = '';
                data = JSON.parse(data);
                    $.each(data, function(v, k){ 
                      strSelect+= '<option value="'+k.Lap_ID+'">'+k.Lap_Asset+'</option>';
                    });
                    // $("#laptop").append(strSelect);
                    $("#laptop").html(strSelect);
                    $("#laptop").chosen();
                    $("#laptop").chosen().trigger('chosen:updated');

              }
            });

    
    $("form#create").submit(function(e){
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
          success: function(data){

              var userLists = "";
              $.each(data, function(k, v){
                userLists += '<li class="list-group-item">Numero: '+v.AS_Emp_Number+'  Nombre: '+v.AS_Employee+'</li>';
              });
              $("#user-list").append(userLists);
              $("#modal-input-name-exists").val($("#employee").val());
              $("#modal-input-employee-exists").val($("#name").val());
              $("#modal-input-uid-exists").val($("#uid").val());
              $("#modal-input-laptop-exists").val($("#laptop option:selected").val());
              $("#asset-exists").text($("#laptop option:selected").text());
              $('#exists-modal').modal();
          
          },
          error: function(){
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
                              success: function(data) {
                                if(data != "Fail")
                                {
                                  
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
                              }
                        });
          }

        });
       
    });



$("form#create2").submit(function(e){
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
                            name:   $("#modal-input-employee-exists").val(),
                            employee: $("#modal-input-name-exists").val(),
                            uid:   $("#modal-input-uid-exists").val(),
                            laptop: $("#modal-input-laptop-exists").val(),
                          },
                          success: function(data) {
                            if(data != "Fail")
                            {
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
                          }
                    });
    
});

   
    $("form#edit").submit(function(e){
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
              success: function(data) {
                if(data != "Fail")
                {
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
                 else{
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


    $("form#delete").submit(function(e){
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
              success: function(data) {
                if(data != "Fail")
                {
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
                 else{
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

    $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
    $('#edit-modal').modal();
  })

  $(document).on('click', "#delete-item", function() {
    $(this).addClass('delete-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
    $('#delete-modal').modal();
  })

  $(document).on('click', "#see-full", function() {
    $('#img-modal').modal();
  })



  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
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
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })

  $('#delete-modal').on('show.bs.modal', function() {
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
  $('#delete-modal').on('hide.bs.modal', function() {
    $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
    $("#delete-form").trigger("reset");
  })



});
</script>
@endsection
