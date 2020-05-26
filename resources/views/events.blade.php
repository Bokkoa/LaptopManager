@extends('partials\master')

@section('content')
<main class="main">
  <div class="container-fluid">


  <br>
  <div class="row justify-content-center">
  <div class="col-md-12">
    <div class="card shadow">
    
  <br>
   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <br>
        <div class="card shadow">
          <div class="card-header">Asignaciones</div>
          <div class="col-12">
          <div class="table-responsive">
            <table id="datatable" class="table table-hover table-striped table-sm text-center " style="font-size: 12px;">
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

</main>
<script type="text/javascript" src="js/scripts/event.js"></script>
@endsection
