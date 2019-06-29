
@extends('theme.LTE.layout')

@section('styles')

@endsection

@section('content')
	<h1>PROFESOR</h1>

	@if(session()->get('success'))
                <div class="demo" id="demod">
                    <p>¡Tu formulario ha sido enviado con exito!</p> 
                    <button  class="btn btn-light" onclick="addedSuccess2()">Aceptar</button>
                </div>
    @endif

  <div class="content" id="app">
    <app/>
  </div>

@endsection


@section('scripts')
<!-- DataTables -->
<script src="{{asset("assets/$theme/bower_components/datatables.net/js/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>
<!-- page script -->
<script src="{{ asset("js/app.js") }}"></script>

<script type="text/javascript">
	window.onload = addedSuccess;
	function addedSuccess() {
       setTimeout(function() {
         document.getElementById("demod").style = "display:none";
       }, 5000);
     }
     function addedSuccess2(){
     
   document.getElementById("demod").style = "display:none";
}
</script>
@endsection
