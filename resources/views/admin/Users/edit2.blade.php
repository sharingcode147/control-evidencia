
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                <h4>Tip!</h4>

                <p>Recuerde llenar todos los campos.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ACTUALIZAR USUARIO</h3>
                        </div>

                        <div class="box-body">

                <form  action="{{ route('users2.update',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                        <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="{{ $user->name }}" disabled>
                            </div>
                        
						
					
					
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Email</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" name="email" value="{{$user->email}}"></input>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Contraseña</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese password" name="pass" ></input>
					</div>
					<button type="submit" href="{{ route('users.index') }}" class="btn btn-info btn-block">Actualizar</button>
					<a href="{{ route('users2.index') }}" class="btn btn-info btn-block" >Atrás</a>
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


