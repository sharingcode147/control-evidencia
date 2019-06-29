@extends('theme.LTE.layout')

@section('content')
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evidencias enviadas a DAC</h3>
            </div>
            <div class="box-body">
              <table id="evidencias" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>R.U.N.</th>
                    <th>Profesor</th>
                    <th>Carrera</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                  </tr>
                </thead>
                @if($evidencias->count())
                @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
	                <tr>
	                  <td>EVID-{{$evidencia->id}}-{{$evidencia->codigo_car}}</td>
	                  <td>{{$evidencia->titulo}}</td>
	                  <td>{{$evidencia->run}}</td>
	                  <td>{{$evidencia->nombre1}} {{$evidencia->nombre2}} {{$evidencia->apellido1}} {{$evidencia->apellido2}}</td>
	                  <td>{{$evidencia->nombre_car}}</td>
	                  <td>{{$evidencia->fecha_realizacion}}</td>
	                  <td><a class="signup" href="{{route('evidencia',$evidencia->id)}}">Ver Evidencia</a></td>
	                </tr>
	      		@endforeach
	      		@endif
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>R.U.N.</th>
                    <th>Profesor</th>
                    <th>Carrera</th>
                    <th>Fecha</th>
                    <th>Ver</th>
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