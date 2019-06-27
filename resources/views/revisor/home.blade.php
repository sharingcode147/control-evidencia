<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
@extends('theme.LTE.layout')

@section('content')
	<h1>REVISOR</h1>
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Rut</th>
                  <th>Nombre</th>
                  <th>Carrera</th>
                  <th>Tiulo</th>
                  <th>Status</th>
                  <th>Fecha</th>
                </tr>
                @if($evidencias->count())
                @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
	                <tr>
	                  <td>{{$evidencia->run}}</td>
	                  <td>{{$evidencia->nombre1}}</td>
	                  <td>{{$evidencia->nombre_car}}</td>
	                  <td>{{$evidencia->titulo}}</td>
	                  <td><span class="label label-warning">Pendiente</span></td>
	                  <td>{{$evidencia->fecha_realizacion}}</td>
	                </tr>
	      		@endforeach
	      		@endif
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@endsection