
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
    <button class="btn btn-block btn-success btn-flat" type="button" id="consultar">
      Consultar
    </button>
  </div>
</div>

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
<script>

$(function () {
	"use strict";
	$("#consultar").on("click",function(){
		var url = "obtenerDatos2";
		$.get(url,function(resul){
			var datos= jQuery.parseJSON(resul);

			var num_ev = datos[0].num_ev;
			var runprof = datos[0].run;
			var num_ev1 = 10;//datos[1].num_ev;
			//var runprof1 = datos[1].run;
			//CHART 1
			var chart1 = new Morris.Donut({
			  element: 'chart1',
			  resize: true,
			  colors: ["#3c8dbc", "#f56954", "#00a65a", "#430e45"],
			  data: [
				{label: runprof, value: num_ev},
				{label: "runprof1", value: num_ev1}
			  ],
			  hideHover: 'auto'
			});

		})
	  
	});
});

</script>


@endsection