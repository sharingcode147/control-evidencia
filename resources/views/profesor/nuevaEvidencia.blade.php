
@extends('theme.LTE.layout')

@section('content')


            <div class="callout callout-info">
                <h4>Tip!</h4>

                <p>Aquí tienes la posibilidad de enviar una evidencia para que Revisores y DAC aprueben o desaprueben. Es recomendable que adjuntes archivos que ayuden a complementar tu solicitud.</p>
            </div>
            <!-- Default box -->
             <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">NUEVA EVIDENCIA</h3>
                </div>

                <div class="box-body">

                    <center>
                        <h2>Documento del Sistema de Gestión de Calidad</h2>
                        <h4>Registros del Sistema de Gestión de Calidad</h4>
                        <h4>Identificación de Registros</h4>
                    </center>

                    <form method="POST" action="{{ route('nuevaEvidenciast') }}" enctype="multipart/form-data">
                        @csrf
                         <!--Nombre usuario -->
                             <div class="form-group">
                                <label>Nombre de usuario:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" disabled>
                                </div>
                             </div>
                            <!-- Carreras -->
                            <div class="form-group">
                                <label>Carrera</label>
                                <select class="form-control" name="name_car">
                                     @foreach ($carreras as $carrera)
                                    <option>{{ $carrera->nombre_car }}</option>
                                @endforeach
                                </select>
                             </div>
                              <!--Titulo de evidencia-->
                
                            <div class="form-group">
                                <label>Titulo:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Example input" name="titulo">
                                    <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                </div>
                            </div>

                             <!--Descripcion -->
     
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="descripcion"></textarea>
                            </div>


                             <!-- Alcance-ambito-tipo -->
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


                             <!-- Cantidad de personas afectadas-->
                             <div class="contenedor">
                                 
                                <div class="row gris-style">
                                    <div class="text-center" role="alert"><h4>Cantidad de personas afectadas</h4></div>
                                    <div class="form-group">
                                        <div class="text-center" role="alert"><label>Interior</label></div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Estudiantes</label>
                                                <div class="input-largo">
                                                    <input type="number"  min="0" max="99999" value="0" name="int_estudiantes">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Profesores</label>
                                                <div class="input-largo">
                                                    <input type="number" min="0" max="99999" value="0" name="int_profesores">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Autoridades</label>
                                                <div class="input-largo">
                                                    <input type="number"  min="0" max="99999" value="0" name="int_autoridades">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Profesionales</label>
                                                <div class="input-largo">
                                                    <input type="number"  min="0" max="99999" value="0" name="int_profesionales">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="text-center" role="alert"><label>Exterior</label></div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Estudiantes</label>
                                                <div class="input-largo">
                                                    <input type="number"  min="0" max="99999" value="0" name="ext_estudiantes">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Profesores</label>
                                                <div class="input-largo">
                                                    <input type="number" min="0" max="99999" value="0" name="ext_profesores">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Autoridades</label>
                                                <div class="input-largo">
                                                    <input type="number"  min="0" max="99999" value="0" name="ext_autoridades">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Profesionales</label>
                                                <div class="input-largo">
                                                    <input type="number"  min="0" max="99999" value="0" name="ext_profesionales">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>

                             <!--fecha realizacion-->

                            <div class="form-group">
                                <label>Fecha realización:</label>
                                <div class="input-group">
                                    <input class="form-control" type="date" value=<?php echo date("Y-m-d") ?> id="example-date-input" name="fecha_realizacion">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                             <!-- subir archivo-->
                            <div class="form-group">
                                <label>Subir archivo:</label>
                                <div class="input-group">
                                    <input class="form-control" type="file" id="archivos" name="archivoEvid" accept="application/pdf, .doc, .docx, .odf, zip, x-rar-compressed">
                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                                <div class="small-info">Exntesiones: .pdf, .doc, .docx, .odf, .zip, .rar permitidas.</div>
                            </div>

                             <!--Subir imagen-->
        
                            <div class="content" id="app">
                                <app/>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer">
                                    @include('includes.boton-form-crear')
                            </div>
                    </form>
                </div>
            </div>
        </div>
            <!-- /.box -->

@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset("assets/$theme/bower_components/datatables.net/js/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>

<script src="{{ asset("js/app.js") }}"></script>
<!-- page script -->

@endsection
