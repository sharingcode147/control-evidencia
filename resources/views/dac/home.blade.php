
@extends('theme.LTE.layout')

@section('content')
<div class="col-md-12">
  <div class="box box-default collapsed-box">
    <div class="box-header with-border">
      <h3 class="box-title">¡Bienvenido D.A.C!</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <p>Revisa - Comenta - Informa - Optimiza. <br><br> Son las principales funciones que encontrarás para gestionar tus evidencias.</p>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

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