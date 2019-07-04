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
  <div class="col-xs-12">
    <div>Prioridad por:</div>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#pri_1" data-toggle="tab">Admin</a></li>
        <li><a href="#pri_2" data-toggle="tab">Profesores</a></li>
        <li><a href="#pri_3" data-toggle="tab">Revisores</a></li>
        <li><a href="#pri_4" data-toggle="tab">DAC</a></li>
      </ul>
      <div class="tab-content">

        <!-- SIN PRIORIDAD -->
        <div class="tab-pane active" id="pri_1">
          	<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Usuarios</h3>
							  <div class="pull-right">
				                <div class="btn-group">
				                  <a href="{{ route('users2.create') }}" class="btn btn-info" >Añadir Usuario</a>
				                </div>
				              	</div>
								</div>
							<div class="box-body">
							  <table id="evidencias1" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							        <th>ID</th>
							        <th>Nombre</th>
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							 
							      </tr>
							    </thead>
							    @if($useradmin->count())
							    @foreach($useradmin as $user)
							      <tr>
							        <td>{{$user->id}}</td>
                    				<td>{{$user->name}}</td>
                    				<td>{{$user->email}}</td>
							        <td><a class="btn btn-success" href="{{action('Admin\Users2Controller@edit', $user->id)}}" ><i class="fa  fa-cog"></i></a></td>
							        <td>
				                    	<form action="{{action('Admin\UsersController@destroy', $user->id)}}" method="post">
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
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
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
							  <h3 class="box-title">Usuarios</h3>
							  <div class="pull-right">
				                <div class="btn-group">
				                  <a href="{{ route('users.create') }}" class="btn btn-info" >Añadir Profesor</a>
				                </div>
				              	</div>
								</div>
							<div class="box-body">
							  <table id="evidencias2" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							        <th>ID</th>
							        <th>Nombre</th>
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							 
							      </tr>
							    </thead>
							    @if($userprofe->count())
								    @foreach($userprofe as $user)
								      <tr>
								        <td>{{$user->id}}</td>
	                    				<td>{{$user->name}}</td>
	                    				<td>{{$user->email}}</td>
								        <td><a class="btn btn-success" href="{{action('Admin\UsersController@edit', $user->id)}}" ><i class="fa  fa-cog"></i></a></td>
								         <td>
				                    	<form action="{{action('Admin\UsersController@destroy', $user->id)}}" method="post">
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
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
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
							  <h3 class="box-title">Usuarios</h3>
							  <div class="pull-right">
				                <div class="btn-group">
				                  <a href="{{ route('users2.create') }}" class="btn btn-info" >Añadir Usuario</a>
				                </div>
				              	</div>
								</div>
							<div class="box-body">
							  <table id="evidencias3" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							        <th>ID</th>
							        <th>Nombre</th>
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							 
							      </tr>
							    </thead>
							    @if($userrevisor->count())
							    @foreach($userrevisor as $user)
							      <tr>
							        <td>{{$user->id}}</td>
                    				<td>{{$user->name}}</td>
                    				<td>{{$user->email}}</td>
							        <td><a class="btn btn-success" href="{{action('Admin\Users2Controller@edit', $user->id)}}" ><i class="fa  fa-cog"></i></a></td>
							        <td>
				                    	<form action="{{action('Admin\Users2Controller@destroy', $user->id)}}" method="post">
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
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							      </tr>                 
							    </tfoot>
							  </table>
							</div>
						</div>

        </div>
        <!--DAC-->
        <div class="tab-pane " id="pri_4">
          	<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Usuarios</h3>
							  <div class="pull-right">
				                <div class="btn-group">
				                  <a href="{{ route('users2.create') }}" class="btn btn-info" >Añadir Usuario</a>
				                </div>
				              	</div>
								</div>
							<div class="box-body">
							  <table id="evidencias4" class="table table-bordered table-striped">
							    <thead>
							      <tr>
							        <th>ID</th>
							        <th>Nombre</th>
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
							 
							      </tr>
							    </thead>
							    @if($userdac->count())
							    @foreach($userdac as $user)
							      <tr>
							        <td>{{$user->id}}</td>
                    				<td>{{$user->name}}</td>
                    				<td>{{$user->email}}</td>
							        <td><a class="btn btn-success" href="{{action('Admin\Users2Controller@edit', $user->id)}}" ><i class="fa  fa-cog"></i></a></td>
							        <td>
				                    	<form action="{{action('Admin\Users2Controller@destroy', $user->id)}}" method="post">
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
							        <th>Email</th>
							        <th>Editar</th>
							        <th>Eliminar</th>
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
    $('#evidencias4').DataTable()
  })
</script>
@endsection

