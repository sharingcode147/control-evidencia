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
        <h3 class="box-title">Cantidad de Evidencias por Alcance</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart1" style="height: 300px; position: relative;"></div>
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

<!-- page script -->
<script>
  $(function () {
    "use strict";
    $("#consul").on("click",function(){
      var url = "GrafAlcance";
      $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var COM =datos.COM;
        var PROV=datos.PROV;
        var REG=datos.REG;
        var NAC=datos.NAC;
        var INT=datos.INT;
        //CHART 1 - EXTERNOS
        var chart1 = new Morris.Donut({
          element: 'chart1',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
          data: [
            {label: "Comunal", value: COM},
            {label: "Provincial", value: PROV},
            {label: "Regional", value: REG},
            {label: "Nacional", value: NAC}
          ],
          hideHover: 'auto'

        });
       
      })

    });
    $("#generar_informe").on("click",function(){
      var url2 ="/consultas/info6";
      this.href = url2;
    });

  });

</script>
@endsection