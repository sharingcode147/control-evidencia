
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                

                <p>Actualice los campos como desee.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ACTUALIZAR DEPARTAMENTOS</h3>
                        </div>

                        <div class="box-body">

                <form method="POST" action="{{ route('departamentos.update',$dep->codigo_dep) }}">
                    @csrf
                    @method('PUT')
                        
					<div class="form-group">
					    <label for="formGroupExampleInput">Nombre Departamento</label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese nombre" name="name" value="{{$dep->nombre_dep}}">
					<div class="form-group">
					    <label for="formGroupExampleInput">Codigo Departamento </label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese carrera" name="codigo_dep" value="{{$dep->codigo_dep}}">
					</div>
    				
					<button type="submit" href="{{ route('departamentos.index') }}" class="btn btn-info btn-block">Actualizar</button>
					<a href="{{ route('departamentos.index') }}" class="btn btn-info btn-block" >Atrás</a>
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


