
@extends('theme.LTE.layout')

@section('content')
	<h1>DAC</h1>
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
			<div class="nav-tabs-custom">
	  			<div class="tab-content">

	        		<!-- SIN PRIORIDAD -->
	        		<div class="tab-pane active" id="pri_1">
						<div class="box">
							<div class="box-header">
							  <h3 class="box-title">Usuarios</h3>
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
							    @if($users->count())
							    @foreach($users as $user)
							      <tr>
							        <td>{{$user->id}}</td>
                    				<td>{{$user->name}}</td>
                    				<td>{{$user->email}}</td>
							        <td><a class="btn btn-success"><i class="fa  fa-cog"></i></a></td>
							        <td>
				                    	<form action="{{action('Admin\UsersController@destroy', $user->id)}}" method="post">
				                       	{{csrf_field()}}
				                       	<input name="_method" type="hidden" value="DELETE">
				     
				                       	<button class="btn btn-danger" type="submit"><span class="fa fa-trash-o"></span></button>
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
  })
</script>
@endsection