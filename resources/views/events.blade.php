@extends('partials\master')

@section('content')
<main class="main">
  <div class="container-fluid">


  <br>
     <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
       

   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <br>
        <div class="card shadow">
          <div class="card-header">Asignaciones</div>
          <div class="col-12">
          <div class="table-responsive">
            <table id="datatable" class="table table-hover table-bordered table-sm text-center " style="font-size: 12px;">
              <thead class="thead-light">
                <tr>
                  <th><strong>#</strong></th>
                  <th><strong>Fecha</strong></th>
                  <th><strong>Puerta</strong></th>
                  <th><strong>Empleado</strong></th>
                  <th><strong>UID</strong></th>
                  <th><strong>Activo</strong></th>
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
</main>
<script type="text/javascript">

function filltable()
{
 
  $.ajax({
              type: 'GET',
              url: 'getevents',
              datatype: 'json',              
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                var table = $("#datatable").DataTable();
                  data = JSON.parse(data);
                    $.each(data, function(k, v){ 
                      console.log(v);
                      table.row.add( [v.EV_ID, v.EV_Date, v.entrance.ENTR_Name, v.EV_Employee, v.EV_Ecode, v.EV_Asset ] ).draw( true );
                    });  
                    $("#datatable").DataTable();
              }
            });
}

$( document ).ready(function() {
  filltable();



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
