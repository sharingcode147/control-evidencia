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
        <h3 class="box-title">Cantidad de Evidencias por Ambito</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart1" style="height: 300px; position: relative;"></div>
      </div>
    </div>
  </div>
  <div class="col-md-12" id="generar_informe1">
    <a class="btn btn-block btn-success btn-flat"  id="generar_informe" >
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
      var url = "grafambito";
      $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var ACA =datos.ACA;
        var EXT=datos.EXT;
        var EAC=datos.EAC;
        var PROD=datos.PROD;
        var INV=datos.INV;
        var GES=datos.GES;
        //CHART 1 - EXTERNOS
        var chart1 = new Morris.Donut({
          element: 'chart1',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45","#4ca600","#a65a00"],
          data: [
            {label: "Acádemico", value: ACA},
            {label: "Extención", value: EXT},
            {label: "E. Academica", value: EAC},
            {label: "Gestión", value: GES},
            {label: "Prooductivo", value: PROD},
            {label: "Investigación", value: INV},
          ],
          hideHover: 'auto'

        });
       
      })

    });
    $("#generar_informe").on("click",function(){
      var rango=$("#reservation").val();
      var array = rango.split("-");
      var inicio = array[0].split("/");
      var fin = array[1].split("/");

      var mes1 = inicio[0].replace(" ","");
      var dia1 = inicio[1].replace(" ","");
      var anio1 = inicio[2].replace(" ","");

      var mes2 = fin[0].replace(" ","");
      var dia2 = fin[1].replace(" ","");
      var anio2 = fin[2].replace(" ","");
      
      var url = "/consultas/informe3/"+anio1+"/"+anio2+"/"+mes1+"/"+mes2+"/"+dia1+"/"+dia2;
      this.href = url;
      
    });
   });
 
  
   

  

</script>
@endsection