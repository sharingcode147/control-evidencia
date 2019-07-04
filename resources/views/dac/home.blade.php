
@extends('theme.LTE.layout')

@section('content')
	<h1>DAC</h1>

@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset("assets/$theme/bower_components/datatables.net/js/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#evidencias1').DataTable()
    $('#evidencias2').DataTable()
    $('#evidencias3').DataTable()
  })
</script>
@endsection