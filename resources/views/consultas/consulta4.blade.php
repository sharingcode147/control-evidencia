@extends('theme.LTE.layout')

@section('styles')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/iCheck/all.css")}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css")}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/timepicker/bootstrap-timepicker.min.css")}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/select2/dist/css/select2.min.css")}}">
@endsection


@section('content')
<div class="row">
  <div class="col-md-12">
    <button class="btn btn-block btn-success btn-flat" type="button" id="consul">
      Consultar
    </button>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Evidencias Pendientes de Revision</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart1" style="height: 300px; position: relative;"></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Evidencias Finalizadas</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart2" style="height: 300px; position: relative;"></div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <a class="btn btn-block btn-success btn-flat" id="generar_informe">
      Generar informe
    </a> 
  </div>

</div>



@endsection

@section('scripts')

<!-- Morris.js charts -->
<script src="{{asset("assets/$theme/bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/morris.js/morris.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme./dist/js/demo.js")}}"></script>
<!-- Select2 -->
<script src="{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<!-- InputMask -->
<script src="{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
<!-- date-range-picker -->
<script src="{{asset("assets/$theme/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset("assets/$theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset("assets/$theme/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js")}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset("assets/$theme/plugins/timepicker/bootstrap-timepicker.min.js")}}"></script>
<!-- SlimScroll -->
<script src="{{asset("assets/$theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset("assets/$theme/plugins/iCheck/icheck.min.js")}}"></script>

<!-- page script -->
<script>
  $(function () {
    "use strict";
    $("#consul").on("click",function(){
      var url = "PendientesCarrera";
      $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var ICI =datos.ICI;
        var INC=datos.INC;
        var ICE=datos.ICE;
        var IND=datos.IND;
        var FICI =datos.FICI;
        var FINC=datos.FINC;
        var FICE=datos.FICE;
        var FIND=datos.FIND;
      
        //CHART 1 - EXTERNOS
        var chart1 = new Morris.Donut({
          element: 'chart1',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
          data: [
            {label: "ICI", value: ICI},
            {label: "INC", value: INC},
            {label: "ICE", value: ICE},
            {label: "IND", value: IND}
          ],
          hideHover: 'auto'

        });
        var chart2 = new Morris.Donut({
          element: 'chart2',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
          data: [
            {label: "ICI", value: FICI},
            {label: "INC", value: FINC},
            {label: "ICE", value: FICE},
            {label: "IND", value: FIND}
          ],
          hideHover: 'auto'

        });

      })

    });

    $("#generar_informe").on("click",function(){
      var url2 ="/consultas/informepen";
      this.href = url2;
    });
  });
</script>
@endsection