
@extends('theme.LTE.layout')
@section('content')
<div class="col-md-6">
    <div class="box box-primary">
    @if($datos->count())
    @foreach($datos as $dato)
            <div class="box-header with-border">
              <h3 class="box-title">Formulario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                    
                  <div class="col-md-4">Profesor: </div>
                    <div class="col-md-8">
                        {{$dato->nombre1}} {{$dato->nombre2}} {{$dato->apellido1}} {{$dato->apellido2}}
                    </div>
                </div>
                <div class="form-grup">
                    <div class="col-md-4">R.U.N: </div>
                    <div class="col-md-8">
                        {{$dato->run}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Carrera: </div>
                    <div class="col-md-8">
                        {{$dato->nombre_car}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Titulo: </div>
                    <div class="col-md-8">
                        {{$dato->titulo}}
                    </div>
                <div class="form-group">
                    <div class="col-md-4">Fecha de Realizacion: </div>
                    <div class="col-md-8">
                        {{$dato->fecha_realizacion}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Fecha de Creacion: </div>
                    <div class="col-md-8">
                        {{$dato->created_at}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Descripción: </div>
                    <div class="col-md-8">
                        {{$dato->descripcion}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Alcance: </div>
                    <div class="col-md-8">
                        {{$dato->alcance}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Ambito: </div>
                    <div class="col-md-8">
                        {{$dato->ambito}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Tipo:</div>
                    <div class="col-md-8">
                        {{$dato->tipo}}
                    </div>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a class="btn btn-primary" href="{{route('home')}}">Volver Atras</a>
              </div>
            </form>
        </div>
        
    @endforeach
    @endif
</div>
@endsection