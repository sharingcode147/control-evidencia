
@extends('theme.LTE.layout')

@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Solicitudes enviadas por profesor</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart1" style="height: 300px; position: relative;"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Tabla informativa</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body chart-responsive">
              <table id="evidencias" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>R.U.N.</th>
                    <th>Profesor</th>
                    <th>Numero solicitudes</th>
                  </tr>
                </thead>
                @if($evidencias->count())
                @foreach($evidencias->sortBy('num_ev') as $evidencia)
                  <tr>
                    <td>{{$evidencia->run}}</td>
                    <td>{{$evidencia->nombre1}} {{$evidencia->nombre2}} {{$evidencia->apellido1}} {{$evidencia->apellido2}}</td>
                    <td><center><span class="label label-primary">{{$evidencia->num_ev}}</span></center></td>
                  </tr>
            @endforeach
            @endif
                <tfoot>
                  <tr>
                    <th>R.U.N.</th>
                    <th>Profesor</th>
                    <th>Numero solicitudes</th>
                  </tr>                 
                </tfoot>
              </table>
      </div>
    </div>    
  </div>

</div>



@endsection

@section('scripts')

<!-- Morris.js charts -->
<script src="{{asset("assets/$theme/bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/morris.js/morris.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme./dist/js/demo.js")}}"></script>
<!-- page script -->
<script>
  $(function () {
    "use strict";

    //CHART 1
    var donut = new Morris.Donut({
      element: 'chart1',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
      data: [
        {label: "19696122-4", value: 5},
        {label: "11044928-9", value: 2}
      ],
      hideHover: 'auto'
    });
    
  });
</script>
@endsection