
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
    <div class="form-group">
      <label>Rango de la consulta:</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="reservation">
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <button class="btn btn-block btn-success btn-flat" type="button" id="consultar">
      Consultar
    </button>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Departamento Ingenieria</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart1" style="height: 300px; position: relative;"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Departamento Salud</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="chart2" style="height: 300px; position: relative;"></div>
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

    $("#consultar").on("click",function(){
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
      

      var url = "obtenerDatos1/"+anio1+"/"+anio2+"/"+mes1+"/"+mes2+"/"+dia1+"/"+dia2;
      $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);

        var ICI =datos.ICI;
        var INC=datos.INC;
        var ICE=datos.ICE;
        var IND=datos.IND;
        
      
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
        //CHART 2 - INTERNOS
        var chart2 = new Morris.Donut({
          element: 'chart2',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
          data: [
            {label: "MED", value: 1},
            {label: "Estudiantes", value: 0},
            {label: "Profesionales", value: 0},
            {label: "Autoridades", value: 0}
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@endsection