@extends('partials\master')

@section('content')
<main class="main">
  <!-- Breadcrumb-->
  <div class="container-fluid">
    <div class="animated fadeIn">
          <div class="row justify-content-center" style="margin-top: 24px;">
              <div class="col-md-12">
                  <div class="card shadow">
                      <div class="card-header">Dashboard</div>

                      <div class="card-body">
                          @if (session('status'))
                              <div class="alert alert-success" role="alert">
                                  {{ session('status') }}
                              </div>
                          @endif
                          You are logged in!
                          {{ Auth::user()->name }} 
                      </div>
                  </div>
              </div>
          </div>
    </div>
  </div>
</main>
@endsection
