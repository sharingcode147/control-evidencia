
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                

                <p>Actualice los campos como desee.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ACTUALIZAR CARRERA</h3>
                        </div>

                        <div class="box-body">

                <form method="POST" action="{{ route('carreras.update',$carreras->codigo_car) }}">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
					    <label for="formGroupExampleInput">DEPARTAMENTOS</label>
					    <select class="form-control" name="codigo_dep">
							@foreach ($dep as $d)

                                <option>{{ $d->codigo_dep }}</option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
					    <label for="formGroupExampleInput">Nombre Carrera </label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese nombre" name="name" value="{{$carreras->nombre_car}}">
					<div class="form-group">
					    <label for="formGroupExampleInput">Codigo carrera </label>
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese carrera" name="codigo_car" value="{{$carreras->codigo_car}}">
					</div>
    				
					<button type="submit" href="{{ route('carreras.index') }}" class="btn btn-info btn-block">Actualizar</button>
					<a href="{{ route('carreras.index') }}" class="btn btn-info btn-block" >Atrás</a>
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


