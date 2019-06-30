@extends('theme.LTE.layout')

@section('content')

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
          <h1>Aqui mostrar formulario</h1>
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