
@extends('theme.LTE.layout')

@section('content')


      <div class="callout callout-info">
        <h4>Tip!</h4>

        <p>Add the layout-boxed class to the body tag to get this layout. The boxed layout is helpful when working on
          large screens because it prevents the site from stretching very wide.</p>
      </div>
      <!-- Default box -->
       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">NUEVA EVIDENCIA</h3>
            </div>
        
            <div class="box-body">
			<form >


			<div class="form-group">
                  <label>Text</label>
                  <input type="text" class="form-control" placeholder="Enter ...">
             </div>

			<h5>Nombre de usuario:</h5>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" disabled>
            </div>
			<br>
             
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="text" class="form-control" placeholder="Username">
            </div>
            <br>


            <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                  	 @foreach ($carreras as $carrera)
			              <option>{{ $carrera->nombre_car }}</option>
			            @endforeach                  
                  </select>
             </div>
			<br>

			<h5>Titulo:</h5>
			 <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
              </div>
              <br>

			<h5>Descripción:</h5>
             <div class="input-group">
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
              </div>

			<div class="input-group">
                  <label>Alcance</label>
                  <select class="form-control">
                  	 @foreach ($alcances as $alcance)
			              <option>{{ $alcance->nombre }}</option>
			            @endforeach                  
                  </select>
             </div>
			<br>


			<div class="input-group">
                  <label>Ambito</label>
                  <select class="form-control">
                  	 @foreach ($ambitos as $ambito)
			              <option>{{ $ambito->nombre }}</option>
			            @endforeach                  
                  </select>
             </div>
			<br>


			<div class="input-group">
                  <label>Tipo</label>
                  <select class="form-control">
                  	 @foreach ($tipos as $tipo)
			              <option>{{ $tipo->nombre }}</option>
			            @endforeach                  
                  </select>
             </div>
			<br>




              <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>
              <br>

              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>

              <h4>With icons</h4>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <br>

              <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
              </div>
              <br>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
              </div>

              <h4>With checkbox and radio inputs</h4>

			
			<div class="row">
                <div class="col-lg-4">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-4">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>

                <div class="col-lg-4">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
            </div>


              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <h4>With buttons</h4>

              <p class="margin">Large: <code>.input-group.input-group-lg</code></p>

              <div class="input-group input-group-lg">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control">
              </div>
              <!-- /input-group -->
              <p class="margin">Normal</p>

              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-danger">Action</button>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control">
              </div>
              <!-- /input-group -->
              <p class="margin">Small <code>.input-group.input-group-sm</code></p>

              <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.box-body -->
				<div class="box-footer">
		            @include('includes.boton-form-crear')
		        </div>
        </form>
    </div>
      <!-- /.box -->

@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset("assets/$theme/bower_components/datatables.net/js/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>
<!-- page script -->

@endsection