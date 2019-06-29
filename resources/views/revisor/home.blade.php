
@extends('theme.LTE.layout')

@section('content')
	<h1>REVISOR</h1>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evidencias pendientes</h3>
            </div>
            <div class="box-body">
              <table id="evidencias" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>R.U.N</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>B</th>
                  </tr>
                </thead>
                @if($evidencias->count())
                @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
	                <tr>
	                  <td>{{$evidencia->run}}</td>
	                  <td>{{$evidencia->nombre1}}</td>
	                  <td>{{$evidencia->nombre_car}}</td>
	                  <td>{{$evidencia->titulo}}</td>
	                  <td><span class="label label-warning">Pendiente</span></td>
	                  <td>{{$evidencia->fecha_realizacion}}</td>
                    <td><a class="btn btn-info"><i class="fa fa-file"></i></a></td>
	                </tr>
	      		@endforeach
	      		@endif
                <tfoot>
                  <tr>
                    <th>R.U.N</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>VER FORMULARIO</th> 
                  </tr>                 
                </tfoot>
              </table>
            </div>
          </div>


@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset("assets/$theme/bower_components/datatables.net/js/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#evidencias').DataTable()
  })
</script>
@endsection