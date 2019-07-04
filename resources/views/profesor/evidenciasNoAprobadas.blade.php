@extends('theme.LTE.layout')

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div>Vista por:</div>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab">Vista general</a></li>
        <li><a href="#datos2" data-toggle="tab">Ver por alcance/ámbito/tipo</a></li>
      </ul>
      <div class="tab-content">

        <!-- GENERAL -->
        <div class="tab-pane active" id="general">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evidencias No Aprobadas</h3>
            </div>
            <div class="box-body">
              <table id="evidencias1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>R.U.N.</th>
                    <th>Profesor</th>
                    <th>Carrera</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                    <th>Editar</th>
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
                    <td  align="center"><a href="{{route('evidencianoap',$evidencia->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></td>
                    <td  align="center"><a href="{{route('edita_evnoaprob',$evidencia->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-pencil-square-o"></i></td>
                  </tr>
                @endforeach
                @else
		            <div class="alert alert-info alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-info"></i> Alerta!</h4>
	                <strong>¡No hay evidencias NO aprobadas!</strong> aún no hay evidencias que no hayan sido aprobadas.
	              </div>
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
                    <th>Editar</th>
                  </tr>                 
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        <!-- ALCANCE -->
        <div class="tab-pane" id="datos2">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evidencias No Aprobadas</h3>
            </div>
            <div class="box-body">
              <table id="evidencias2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Alcance</th>
                    <th>Ámbito</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                @if($evidencias->count())
                @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
                  <tr>
                    <td>EVID-{{$evidencia->id}}-{{$evidencia->codigo_car}}</td>
                    <td>{{$evidencia->titulo}}</td>
                    <td>{{$evidencia->alcance}}</td>
                    <td>{{$evidencia->ambito}}</td>
                    <td>{{$evidencia->tipo}}</td>
                    <td>{{$evidencia->fecha_realizacion}}</td>
                    <td  align="center"><a href="{{route('evidencianoap',$evidencia->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></td>
                    <td  align="center"><a href="{{route('edita_evnoaprob',$evidencia->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-pencil-square-o"></i></td>
                  </tr>
                @endforeach
                @else
		            <div class="alert alert-info alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-info"></i> Alerta!</h4>
	                <strong>¡No hay evidencias NO aprobadas!</strong> aún no hay evidencias que no hayan sido aprobadas.
	              </div>
                @endif
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Alcance</th>
                    <th>Ámbito</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                    <th>Editar</th>
                  </tr>                 
                </tfoot>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
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
    $('#evidencias1').DataTable()
    $('#evidencias2').DataTable()
  })
</script>
@endsection