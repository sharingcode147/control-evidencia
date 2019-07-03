
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                <h4>Tip!</h4>

                <p>Add the layout-boxed class to the body tag to get this layout. The boxed layout is helpful when working on
                    large screens because it prevents the site from stretching very wide.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ACTUALIZAR PROFESOR</h3>
                        </div>

                        <div class="box-body">

                <form method="POST" action="{{ route('users.update',$user->id) }}">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
					    <label for="formGroupExampleInput">Carrera</label>
					    <select class="form-control" name="codigo_car">
							@foreach ($carreras as $carrera)

                                <option>{{ $carrera->codigo_car }}</option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
					    <label for="formGroupExampleInput">Run </label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese Run" name="run" value="{{$profe->run}}">
					</div>
    				<div class="form-group">
					    <label for="formGroupExampleInput">Nombre 1</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese Primer Nombre" name="name1" value="{{$profe->nombre1}}">
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Nombre 2</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese Segundo Nombre" name="name2" value="{{$profe->nombre2}}"></input>
					</div>
					
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Apellido Paterno</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese Apellido Pat." name="paterno" value="{{$profe->apellido1}}"></input>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Apellido Materno</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese Apellido Mat." name="materno" value="{{$profe->apellido2}}"></input>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Email</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" name="email" value="{{$user->name}}"></input>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Contraseña</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese password" name="pass" value="Nueva contraseña"></input>
					</div>
					<button type="submit" href="{{ route('users.index') }}" class="btn btn-info btn-block">Actualizar</button>
					<a href="{{ route('users.index') }}" class="btn btn-info btn-block" >Atrás</a>
                </form>
        </div>
            <!-- /.box -->

@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset("assets/$theme/bower_components/datatables.net/js/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>

<script src="{{ asset("js/app.js") }}"></script>
<!-- page script -->

@endsection


