
@extends('theme.LTE.layout')
@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="col-md-12 alert alert-danger" role="alert">
            <button class='close' data-dismiss="alert">
                &times;
            </button>
            {{ $error }}
        </div>
    @endforeach
@endif

<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#form" data-toggle="tab">Formulario</a></li>
        <li><a href="#obs" data-toggle="tab">Observaciones
              <span class="label label-danger">{{$observaciones->count()}}</span>
        </a></li>
      </ul>

      <div class="tab-content">

        <!-- Formulario -->
        <div class="tab-pane active" id="form">
          @foreach($datos as $dato)
          <h1>Aqui mostrar formulario</h1>
          <div class="card-footer text-center">
            <div class="row">
              <div class="col-md-6">
                <a class="btn btn-success btn-block" href="{{route('aprobarEvidenciaDac',$dato->evidencia_id)}}">Aprobar</a>
              </div>
              <div class="col-md-6">
                <button type="button" class="btn btn-block btn-danger" data-toggle="collapse" data-target="#form-obs">Rechazar con observaciones</button>
              </div>

            </div>
        
            <div id="form-obs" class="collapse">
                <form method="POST" action="{{ route('observacionDac',$dato->evidencia_id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="observacionArea">Por favor, agregue sus observaciones y luego presione guardar.</label>
                        <textarea class="form-control" id="observacionArea" rows="3" name="observacionDac"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
          </div>
          @endforeach
        </div>

        <!-- Observaciones -->
        <div class="tab-pane" id="obs">
          @if($observaciones->count())
          <ul class="timeline">

           @foreach($observaciones as $observacion)
            <li class="time-label">
              
              <span class="bg-light">
                {{date('d-m-Y', strtotime($observacion->created_at))}}
              </span>
              
              @if($observacion->nivel == 1)
                <span class="bg-blue">Profesor</span>
              @endif
              @if($observacion->nivel == 2)
                <span class="bg-yellow">Revisor</span>
              @endif
              @if($observacion->nivel == 3)
                <span class="bg-red">D.A.C.</span>
              @endif     

            </li>

            <li>
              @if($observacion->nivel == 1)
                <i class="fa fa-comments bg-blue"></i>
              @endif
              @if($observacion->nivel == 2)
                <i class="fa fa-comments bg-yellow"></i>
              @endif
              @if($observacion->nivel == 3)
                <i class="fa fa-comments bg-red"></i>
              @endif  

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>{{date('H:i:s', strtotime($observacion->created_at))}}</span>

                <h3 class="timeline-header"><a href="#">{{$observacion->name}}</a> / {{$observacion->email}}</h3>

                <div class="timeline-body">
                  {{$observacion->observacion}}
                </div>
              </div>
            </li>
            @endforeach

          </ul>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

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