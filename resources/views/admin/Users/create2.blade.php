
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                <h4>Tip!</h4>

                <p>Recuerde NO dejar ningun campo vacio.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">NUEVO USUARIO</h3>
                        </div>

                        <div class="box-body">

                <form method="POST" action="{{ route('users2.store') }}">
                    @csrf
                        <div class="form-group">
					    <label for="formGroupExampleInput">Carrera</label>
					    <select class="form-control" name="name">
							<option value="admin">admin</option>
							<option value="dac">dac</option>
							<option value="revisor">revisor</option>
						</select>
					</div>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Email</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese email" name="email"></input>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Contraseña</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese password" name="pass"></input>
					</div>
					<button type="submit" href="{{ route('users2.index') }}" class="btn btn-primary">Submit</button>
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


