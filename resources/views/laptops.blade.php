@extends('partials\master')

@section('content')
<main class="main">
  <div class="container-fluid">
    <br>
     <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Laptops</div>
          <form id="create" action="createlaptop" method="post" style="padding:5px;">
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="asset">Activo:</label>
                  <input type="asset" class="form-control form-control-sm" name="asset" id="asset" required>
                </div>
              </div>
              <div class="col-6">
              
                <div class="form-group">
                    <label for="owner">Usuario:</label>
                    <input type="text" name="owner" id="owner" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
            
          <button type="submit" class="btn btn-laptop btn-sm">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>

   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">Laptops</div>
            <div class="col-12">
          <div class="table-responsive">
            <table id="datatable" class="table table-hover table-bordered table-sm text-center ">
              <thead class="alert-warning">
                <tr>
                  <th><strong>#</strong></th>
                  <th><strong>Activo</strong></th>
                  <th><strong>Usuario</strong></th>
                  <th><strong>Fecha de Creación</strong></th>
                  <th><strong>Usuario de Creación</strong></th>
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
        <h4 class="modal-title" align="center"><b>Modificar activo</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="editlaptop" method="post" id="edit">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="box-body">
            <div class="form-group">
            <input type="hidden" name="id" id="modal-input-id">
              <label for="modal-input-asset">Activo</label>
              <input type="text" class="form-control" id="modal-input-asset" name="asset" required>
            </div>
            <div class="form-group">
              <label for="modal-input-owner">Usuario</label>
              <input type="text" class="form-control" id="modal-input-owner" name="owner" required>
            </div>
            <div class="form-group">
              <label for="modal-input-cdate">Fecha de Creacion</label>
              <input type="text" class="form-control" id="modal-input-cdate" name="cdate" readonly>
            </div>
            <div class="form-group">
              <label for="modal-input-cuser">Usuario de Creacion</label>
              <input type="text" class="form-control" id="modal-input-cuser" name="cuser" readonly>
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
      <h4 class="modal-title" align="center"><b>Eliminar Activo</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form role="form" action="checklaptops" method="post" id="delete">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="box-body">
          <div class="form-group">
            <label for="modal-input-asset-delete">Activo</label>
            <input type="hidden" name="id" id="modal-input-id-delete">
            <input type="text" class="form-control" id="modal-input-asset-delete" name="asset" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-owner-delete">Usuario de creacion</label>
            <input type="text" class="form-control" id="modal-input-owner-delete" name="owner" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-cuser-delete">Usuario de creacion</label>
            <input type="text" class="form-control" id="modal-input-cuser-delete" name="cuser" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-cdate-delete">Fecha de creacion</label>
            <input type="text" class="form-control" id="modal-input-cdate-delete" name="cdate" readonly>
          </div>
        </div>
        <label><strong>¿Estás seguro de que deseas eliminar este registro?</strong></label>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button id="btn-check" type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<!-- LINKED MODAL -->

<div class="modal fade" id="linked-modal">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" align="center"><b>Activos Vinculados</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
    <div class="alert alert-warning">Las siguientes asignaciones serán eliminadas: </div>
      
      <!-- LIST OF USERS -->
      <ul id="users" class="list-group"> 
      </ul>
      
      <form role="form" action="deletelaptop" method="post" id="linked">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="box-body">
          <div class="form-group">
            <label for="modal-input-asset-delete-2">Activo</label>
            <input type="hidden" name="id" id="modal-input-id-delete-2">
            <input type="text" class="form-control" id="modal-input-asset-delete-2" name="asset" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-owner-delete-2">Usuario</label>
            <input type="text" class="form-control" id="modal-input-owner-delete-2" name="owner" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-cuser-delete-2">Usuario de creacion</label>
            <input type="text" class="form-control" id="modal-input-cuser-delete-2" name="cuser" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-cdate-delete-2">Fecha de creacion</label>
            <input type="text" class="form-control" id="modal-input-cdate-delete-2" name="cdate" readonly>
          </div>
        </div>
        <label><strong>¿Estás seguro de que deseas eliminar este registro?</strong></label>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button id="btn-check" type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

</main>
<script type="text/javascript" src="js/scripts/laptop.js"></script>
@endsection
