@extends('partials\master')

@section('content')
<main class="main">
  <div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 24px;">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Buscar Usuario</div>
          <form id="search" style="padding:5px;">
            <div class="form-group">
              <label for="ui">UID:</label>
              <input id="searchName" type="ui" class="form-control" id="ui" placeholder="" required>
            </div>
            <button id="searchBtn" class="btn btn-warning">Buscar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Nuevo Usuario</div>
          <form class="" action="createuser" method="post" style="padding:5px;">
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="ui">UID:</label>
                  <input type="ui" class="form-control" name="uid" id="uid" required readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="usr">Name:</label>
                  <input type="text" class="form-control" name="usr" id="usr" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="usr" id="mail-label">Email:</label>
                  <input type="text" class="form-control" name="mail" id="mail">
                </div>
              </div>
            </div>
          <button type="submit" class="btn btn-warning">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>
</main>
<script type="text/javascript">
    $(document).ready(function(){
        $("form#search").submit(function(e){
          e.preventDefault();
          $.ajax({
              type: 'POST',
              url: 'userlookup',
              dataType: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
                input: $("#searchName").val()
              },
              success: function(data) {
                  $("#uid").val($("#searchName").val());
                  $("#usr").val(data[0]);
                  if (data[1] === null) {
                    $("#mail-label").hide();
                    $("#mail").val("").prop("readonly", true).hide();
                  }
                  else {
                    $("#mail-label").show();
                    $("#mail").val(data[1]).prop("readonly", false).show();
                  }
              }
          });
   });
});
</script>
@endsection
