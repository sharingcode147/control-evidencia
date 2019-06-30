
@extends('theme.LTE.layout')

@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Asistentes externos</h3>

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
        <h3 class="box-title">Asistentes internos</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart2" style="height: 300px; position: relative;"></div>
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
        {label: "Profesores", value: 12},
        {label: "Estudiantes", value: 1},
        {label: "Profesionales", value: 20},
        {label: "Autoridades", value: 20}
      ],
      hideHover: 'auto'
    });

    //CHART 2
    var donut = new Morris.Donut({
      element: 'chart2',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
      data: [
        {label: "Profesores", value: 12},
        {label: "Estudiantes", value: 30},
        {label: "Profesionales", value: 20},
        {label: "Autoridades", value: 20}
      ],
      hideHover: 'auto'
    });
    
  });
</script>
@endsection