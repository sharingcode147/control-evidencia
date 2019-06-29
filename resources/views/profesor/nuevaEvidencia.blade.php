
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

                <form method="POST" action="{{ route('nuevaEvidenciast') }}">
                    @csrf
                         <div class="form-group">
                            <label>Nombre de usuario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" disabled>
                            </div>
                         </div>

                        <div class="form-group">
                            <label>Carrera</label>
                            <select class="form-control" name="name_car">
                                 @foreach ($carreras as $carrera)
                                <option>{{ $carrera->nombre_car }}</option>
                            @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                            <label>Titulo:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Example input" name="titulo">
                                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="descripcion"></textarea>
                        </div>


                         <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Alcance</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>

                                            <select class="form-control" name="name_alcance">
                                                 @foreach ($alcances as $alcance)
                                                <option>{{ $alcance->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Ambito</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <select class="form-control" name="name_ambito">
                                                 @foreach ($ambitos as $ambito)
                                                <option>{{ $ambito->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <select class="form-control" name="name_tipo">
                                                 @foreach ($tipos as $tipo)
                                                <option>{{ $tipo->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>



                        <div class="row">
                            <div class="text-center" role="alert">Cantidad de personas afectadas</div>
                            <div class="form-group">
                                <div class="text-center" role="alert">Interior</div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Estudiantes</label>
                                        <div class="input-group">
                                            <input type="number"  min="0" max="99999" value="0" name="int_estudiantes">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Profesores</label>
                                        <div class="input-group">
                                            <input type="number" min="0" max="99999" value="0" name="int_profesores">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Autoridades</label>
                                        <div class="input-group">
                                            <input type="number"  min="0" max="99999" value="0" name="int_autoridades">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Profesionales</label>
                                        <div class="input-group">
                                            <input type="number"  min="0" max="99999" value="0" name="int_profesionales">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="text-center" role="alert">Exterior</div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Estudiantes</label>
                                        <div class="input-group">
                                            <input type="number"  min="0" max="99999" value="0" name="ext_estudiantes">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Profesores</label>
                                        <div class="input-group">
                                            <input type="number" min="0" max="99999" value="0" name="ext_profesores">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Autoridades</label>
                                        <div class="input-group">
                                            <input type="number"  min="0" max="99999" value="0" name="ext_autoridades">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="example-date-input">Profesionales</label>
                                        <div class="input-group">
                                            <input type="number"  min="0" max="99999" value="0" name="ext_profesionales">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Fecha realización:</label>
                            <div class="input-group">
                                <input class="form-control" type="date" id="example-date-input" name="fecha_realizacion">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
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
