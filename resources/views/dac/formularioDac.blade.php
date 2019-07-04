
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
          <center>
            <h2>Documento del Sistema de Gestión de Calidad</h2>
            <h4>Registros del Sistema de Gestión de Calidad</h4>
            <h4>Identificación de Registros</h4>
          </center>
          

          <!--fecha realizacion-->

          <div class="form-group">
            <label>Fecha realización: {{$dato->fecha_realizacion}}</label>
          </div>
          <div class="form-group">
            <label>Fecha de ingreso al sistema: {{$dato->created_at}}</label>
          </div>

          <!--Nombre usuario -->
          <div class="form-group">
            <label>Nombre de usuario:</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <label class="form-control">{{$dato->nombre1}} {{$dato->nombre2}} {{$dato->apellido1}} {{$dato->apellido2}}</label>
            </div>
          </div>
          <!-- Carrera -->
          <div class="form-group">
            <label>Carrera</label>
            <label class="form-control">{{$dato->nombre_car}}</label>
          </div>
          <!--Titulo de evidencia-->

          <div class="form-group">
            <label>Titulo:</label>
            <div class="input-group">
                <label class="form-control">{{$dato->titulo}}</label>
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
            </div>
          </div>

          <!--Descripcion -->

          <div class="form-group">
            <label>Descripción:</label>
            <label class="form-control">{{$dato->descripcion}}</label>
          </div>


          <!-- Alcance-ambito-tipo -->
          <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Alcance: {{$dato->alcance}}</label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Ámbito: {{$dato->ambito}}</label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Tipo: {{$dato->tipo}}</label>
                    </div>
                </div>
          </div>


          <!-- Cantidad de personas afectadas-->
          <div class="contenedor">
             
            <div class="row gris-style">
                <div class="text-center" role="alert"><h4>Cantidad de personas afectadas</h4></div>
                <div class="form-group">
                    <div class="text-center" role="alert"><label>Interior</label></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Estudiantes</label>
                            <label class="form-control">{{$dato->int_estudiantes}}</label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-date-input">Profesores</label>
                            <div class="input-largo">
                               <label class="form-control">{{$dato->int_profesores}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-date-input">Autoridades</label>
                            <div class="input-largo">
                                <label class="form-control">{{$dato->int_autoridades}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-date-input">Profesionales</label>
                            <div class="input-largo">
                                <label class="form-control">{{$dato->int_profesionales}}</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="text-center" role="alert"><label>Exterior</label></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Estudiantes</label>
                            <label class="form-control">{{$dato->ext_estudiantes}}</label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-date-input">Profesores</label>
                            <div class="input-largo">
                               <label class="form-control">{{$dato->ext_profesores}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-date-input">Autoridades</label>
                            <div class="input-largo">
                                <label class="form-control">{{$dato->ext_autoridades}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-date-input">Profesionales</label>
                            <div class="input-largo">
                                <label class="form-control">{{$dato->ext_profesionales}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>


          <!-- ACCIONES FORMULARIO -->
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


@endsection