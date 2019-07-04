@extends('theme.LTE.layout')

@section('content')
<h1>ADMIN</h1>

@if(Session::has('success'))
    <div class="col-md-12 alert alert-success" role="alert">
        <button class='close' data-dismiss="alert">
            &times;
        </button>
        {{Session::get('success')}}
    </div>
@endif

<div class="row">
  
      <div class="tab-content">

        <!-- SIN PRIORIDAD -->
        <div class="tab-pane active" id="pri_1">
          	<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Carreras</h3>
							  <div class="pull-right">
				                <div class="btn-group">
				                  <a href="{{ route('carreras.create') }}" class="btn btn-info" >Añadir Carrera</a>
				                </div>
				              	</div>
								</div>
							<div class="box-body">
							  <table id="evidencias1" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							        <th>ID</th>
							        <th>Nombre</th>
							        <th>Departamento</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							 
							      </tr>
							    </thead>
							    @if($carrera->count())
							    @foreach($carrera as $car)
							      <tr>
							        <td>{{$car->codigo_car}}</td>
                    				<td>{{$car->nombre_car}}</td>
                    				<td>{{$car->codigo_dep}}</td>
							        <td><a class="btn btn-success" href="{{action('Admin\CarrerasController@edit', $car->codigo_car)}}"><i class="fa  fa-cog"></i></a></td>
							        <td>
				                    	<form action="{{action('Admin\CarrerasController@destroy', $car->codigo_car)}}" method="post">
				                       	{{csrf_field()}}
				                       	<input name="_method" type="hidden" value="DELETE">
				     
				                       	<button class="btn btn-danger" type="submit"><span class="fa fa-trash-o"></span></button></form>
				                    </td>
							        
							      </tr>
								@endforeach
								@endif
							    <tfoot>
							      <tr>
							        <th>ID</th>
							        <th>Nombre</th>
							        <th>Departamento</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							      </tr>                 
							    </tfoot>
							  </table>
							</div>
						</div>

          
        </div>

        <!-- CANTIDAD DE REVISIONES -->
        

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
 
  })
</script>
@endsection

