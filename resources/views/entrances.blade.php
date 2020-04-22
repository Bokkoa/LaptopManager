@extends('partials\master')

@section('content')
<main class="main">
  

<div class="container-fluid">

    <br>
     <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Entradas</div>
          <form id="create" action="createentrance" method="post" style="padding:5px;">
            @csrf
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="name">Nombre:</label>
                  <input type="text" name="name" id="name" class="form-control" required>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label for="name">HostName:</label>
                  <input type="text" name="asset" id="asset" class="form-control" required>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label for="asset">Zona:</label>
                  <select name="location" id="location" class="form-control" required>
                  <option value="1">Norte</option>
                  <option value="2">Sur</option>
                  <option value="3">Este</option>
                  <option value="4">Oeste</option>
                  </select>
                </div>
              </div>
             
            </div>
        
            
          <button type="submit" class="btn btn-laptop">Crear</button>
          <br>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>

   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Entradas</div>
          <div class="col-12">
          <div class="table-responsive">
            <table id="datatable" class="table table-hover table-bordered table-sm text-center ">
              <thead class="thead-light">
                <tr>
                  <th><strong>#</strong></th>
                  <th><strong>Nombre</strong></th>
                  <th><strong>HostName</strong></th>
                  <th><strong>Localidad</strong></th>
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



<div class="modal fade" id="edit-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" align="center"><b>Modificar entrada</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit" role="form" action="editasignation" method="post" id="edit">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="box-body">
              <div class="form-group"> 
                <label for="modal-input-id">Número</label>
                <input type="text" class="form-control" id="modal-input-id" name="id" readonly>
              </div>
              <div class="form-group">
                <label for="modal-input-name">Nombre</label>
                <input type="text" class="form-control" id="modal-input-name" name="name" required>
              </div>
              <div class="form-group">
                <label for="modal-input-asset">HostName</label>
                <input type="text" class="form-control" id="modal-input-asset" name="asset" required>
              </div>
              <div class="form-group">
                <label for="modal-input-location">Localidad</label>
                <select name="location" id="modal-input-location" class="form-control">
                  <option value="1">Norte</option>
                  <option value="2">Sur</option>
                  <option value="3">Este</option>
                  <option value="4">Oeste</option>
                </select>
                <!-- <input type="text" class="form-control" id="modal-input-location" name="location" required> -->
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
      <h4 class="modal-title" align="center"><b>Eliminar entrada</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form id="delete" role="form" action="deleteasignation" method="post" id="delete">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="box-body">
          <div class="form-group">
            <label for="modal-input-id-delete">Numero de entrada</label>
            <input type="text" class="form-control" id="modal-input-id-delete" name="id" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-name-delete">Nombre</label>
            <input type="text" class="form-control" id="modal-input-name-delete" name="name" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-asset-delete">Activo</label>
            <input type="text" class="form-control" id="modal-input-asset-delete" name="asset" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-location-delete">Localidad</label>
            <input type="text" class="form-control" id="modal-input-location-delete" name="location" readonly>
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
<script type="text/javascript" src="js/scripts/entrances.js"></script>
@endsection
