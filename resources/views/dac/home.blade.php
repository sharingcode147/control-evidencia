
@extends('theme.LTE.layout')

@section('content')
	<h1>DAC</h1>
		
	<div class="row">
	  	<div class="col-xs-12">
			<div>Prioridad por:</div>
			<div class="nav-tabs-custom">
	  			<ul class="nav nav-tabs">
	    			<li class="active"><a href="#pri_1" data-toggle="tab">Sin prioridad</a></li>
	    			<li><a href="#pri_2" data-toggle="tab">Cantidad de revisiones</a></li>
	    			<li><a href="#pri_3" data-toggle="tab">Días en el sistema</a></li>
	  			</ul>
	  			<div class="tab-content">

	        		<!-- SIN PRIORIDAD -->
	        		<div class="tab-pane active" id="pri_1">
						<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Evidencias pendientes</h3>
							</div>
							<div class="box-body">
							  <table id="evidencias1" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							        <th>R.U.N</th>
							        <th>Nombre</th>
							        <th>Carrera</th>
							        <th>Título</th>
							        <th>Estado</th>
							        <th>Fecha</th>
							        <th>Ver</th>
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
							        <td><a class="btn btn-info" href="{{route('formularioDac-show',$evidencia->id)}}"><i class="fa fa-file"></i></a></td>
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
							        <th>Ver</th>
							      </tr>                 
							    </tfoot>
							  </table>
							</div>
						</div>

	        		</div>

					<!-- CANTIDAD DE REVISIONES -->
	        		<div class="tab-pane" id="pri_2">
						<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Evidencias pendientes</h3>
							</div>
							<div class="box-body">
							  <table id="evidencias2" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							      	<th></th>
							        <th>R.U.N</th>
							        <th>Nombre</th>
							        <th>Carrera</th>
							        <th>Título</th>
							        <th>Estado</th>
							        <th>Fecha</th>
							        <th>Ver</th>
							      </tr>
							    </thead>
							    @if($evidencias->count())
							    @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
							      <tr>
							      	<td><center><span class="label label-primary">{{$evidencia->revisiones}}</span></center></td>
							        <td>{{$evidencia->run}}</td>
							        <td>{{$evidencia->nombre1}}</td>
							        <td>{{$evidencia->nombre_car}}</td>
							        <td>{{$evidencia->titulo}}</td>
							        <td><span class="label label-warning">Pendiente</span></td>
							        <td>{{$evidencia->fecha_realizacion}}</td>
							        <td><a class="btn btn-info" href="{{route('formularioDac-show',$evidencia->id)}}"><i class="fa fa-file"></i></a></td>
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
							        <th>Ver</th>
							      </tr>                 
							    </tfoot>
							  </table>
							</div>
						</div>
	        		</div>

	        		<!-- DÍAS EN EL SISTEMA -->
	        		<div class="tab-pane" id="pri_3">
						<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Evidencias pendientes</h3>
							</div>
							<div class="box-body">
							  <table id="evidencias3" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							      	<th></th>
							        <th>R.U.N</th>
							        <th>Nombre</th>
							        <th>Carrera</th>
							        <th>Título</th>
							        <th>Estado</th>
							        <th>Fecha</th>
							        <th>Ver</th>
							      </tr>
							    </thead>
							    @if($evidencias->count())
							    @foreach($evidencias->sortBy('fecha_realizacion') as $evidencia)
							      <tr>
							      	<td><center><span class="label label-primary">{{$evidencia->dias}}</span></center></td>
							        <td>{{$evidencia->run}}</td>
							        <td>{{$evidencia->nombre1}}</td>
							        <td>{{$evidencia->nombre_car}}</td>
							        <td>{{$evidencia->titulo}}</td>
							        <td><span class="label label-warning">Pendiente</span></td>
							        <td>{{$evidencia->fecha_realizacion}}</td>
							        <td><a class="btn btn-info" href="{{route('formularioDac-show',$evidencia->id)}}"><i class="fa fa-file"></i></a></td>
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
							        <th>Ver</th>
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
    $('#evidencias3').DataTable()
  })
</script>
@endsection