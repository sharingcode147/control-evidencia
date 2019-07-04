
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                <h4>Tip!</h4>

                <p>Recuerde llenar todos los campos.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">NUEVA CARRERA</h3>
                        </div>

                        <div class="box-body">

                <form method="POST" action="{{ route('departamentos.store') }}">
                    @csrf
                        
					
					<div class="form-group">
					    <label for="formGroupExampleInput">Nombre Departamento </label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese nombre" name="name">
					</div>
					
				
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Codigo Departamento</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese codigo" name="codigo"></input>
					</div>
					
					<button type="submit" href="{{ route('departamentos.index') }}" class="btn btn-primary">Crear</button>
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


