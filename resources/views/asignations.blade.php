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
            <img id="employee-image" src="" class="image-responsive rounded-lg border-primary" />
            <div class="overlay" style=" width: 250px;">
              <h2> <a id="see-full" class="btn btn-laptop"> <i class="fas fa-eye"></i> </a></h2>
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
      <div class="modal-header bg-laptop">
        <h4 class="modal-title" align="center"><b>Imagen</b></h4>
        <button type="button" class="close btn-laptop" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
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
<script type="text/javascript" src="js/scripts/asignation.js"></script>
@endsection
