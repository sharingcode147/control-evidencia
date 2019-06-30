
@extends('theme.LTE.layout')

@section('content')
	<h1>ADMIN</h1>
	<div class="box">
		<div class="box-header">
		  <h3 class="box-title">Evidencias en progreso</h3>
		</div>
		<div class="box-body">
		  <table id="evidencias" class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th>R.U.N</th>
		        <th>Nombre</th>
		        <th>Carrera</th>
		        <th>Título</th>
		        <th>Nivel</th>
		        <th>Fecha</th>
		      </tr>
		    </thead>
		    @if($evidencias->count())
		    @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
		      <tr>
		        <td>{{$evidencia->run}}</td>
		        <td>{{$evidencia->nombre1}}</td>
		        <td>{{$evidencia->nombre_car}}</td>
		        <td>{{$evidencia->titulo}}</td>
		        @if($evidencia->nivel == 1)
		        	<td><span class="label label-primary">Profesor</span></td>
		        @endif
		        @if($evidencia->nivel == 2)
		        	<td><span class="label label-warning">Revisor</span></td>
		        @endif
		        @if($evidencia->nivel == 3)
		        	<td><span class="label label-danger">D.A.C.</span></td>
		        @endif
		        <td>{{$evidencia->fecha_realizacion}}</td>
		      </tr>
			@endforeach
			@endif
		    <tfoot>
		      <tr>
		        <th>R.U.N</th>
		        <th>Nombre</th>
		        <th>Carrera</th>
		        <th>Título</th>
		        <th>Nivel</th>
		        <th>Fecha</th>
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