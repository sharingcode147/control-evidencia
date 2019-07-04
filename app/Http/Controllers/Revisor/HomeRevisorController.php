<?php
namespace App\Http\Controllers\Revisor;
use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Fpdf;
class HomeRevisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        return view('revisor.home');
    }
    public function colaRevisor()
    {
        //Obteniendo los datos sobre evidencias.
        $evidencias = Evidencia::where('estado','Pendiente')
                                ->where('nivel','2')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion','evidencias.id as evidencia_id', 'evidencias.codigo_car')
                                ->paginate(8);
        //  Obteniendo la cantidad de observaciones que tienen las evidencias.
        $num_observaciones = Observaciones::select(DB::raw('count(*) as revisiones, evidencia_id'))
                                            ->groupBy('evidencia_id')
                                            ->get();
        //  Recorriendo las evidencias
        foreach ($evidencias as $evidencia) {
            $evidencia->revisiones = 0; //Asumo que la evidencia no tiene observaciones.
            foreach ($num_observaciones as $obs) {
                //  Revisando si la evidencia tiene observaciones y asignandolas en caso de ser asi.
                if($obs->evidencia_id == $evidencia->id){
                    $evidencia->revisiones = $obs->revisiones;
                }
            }
            $fecha_actual = new Carbon;
            $fecha = Carbon::parse($evidencia->fecha_creacion);
            $evidencia->dias = $fecha_actual->diffInDays($fecha);;
        }
        
            
        return view('revisor.evCursoRevisor',["evidencias"=>$evidencias]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (is_numeric($id)){
            $id_form = Evidencia::where('id',$id)
                                ->where('nivel','2')
                                ->select('formulario_id')->first();
            if (empty($id_form))
                $formulario_id = 0;
            else
                $formulario_id = $id_form->formulario_id;
            $datos = Formulario::where('formularios.id',$formulario_id)
                                ->join('ambito','ambito.id','=','formularios.ambito_id')
                                ->join('alcance','alcance.id','=','formularios.alcance_id')
                                ->join('tipo','tipo.id','=','formularios.tipo_id')
                                ->join('evidencias','evidencias.formulario_id','=','formularios.id')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->join('departamentos','carreras.codigo_dep','=','departamentos.codigo_dep')
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id','evidencias.created_at','departamentos.nombre_dep')
                                ->get();
            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('revisor.formularioEvidencia',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
        
    }
    //Funcion para obtener las evidencias aprobadas
    public function getAp()
    {
        //Evidencias Aprobadas por Dac
        $evidencias = Evidencia::where([['estado','Finalizada'],['nivel',3],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();
        return view('revisor.evidenciaAprobadasDacRev',["evidencias"=>$evidencias]);
    }
    //Funcion para obtener las evidencias no aprobadas
    public function getNoAp()
    {
        //Evidencias Rechazadas
        $evidencias = Evidencia::where([['estado','Pendiente'],['nivel',1],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();
        return view('revisor.evidenciaNoAprobadas',["evidencias"=>$evidencias]);
    }
    //Funcion para mostrar las evidencias aprobadas y no aprobadas.
    public function showAprobadas($id)
    {
        //
        if (is_numeric($id)){
            $id_form = Evidencia::where('id',$id)->select('formulario_id')->first();
            if (empty($id_form))
                $formulario_id = 0;
            else
                $formulario_id = $id_form->formulario_id;
            $datos = Formulario::where('formularios.id',$formulario_id)
                                ->join('ambito','ambito.id','=','formularios.ambito_id')
                                ->join('alcance','alcance.id','=','formularios.alcance_id')
                                ->join('tipo','tipo.id','=','formularios.tipo_id')
                                ->join('evidencias','evidencias.formulario_id','=','formularios.id')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->join('departamentos','carreras.codigo_dep','=','departamentos.codigo_dep')
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id','evidencias.nivel','evidencias.estado', 'departamentos.nombre_dep')
                                ->get();
            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('revisor.evidenciaAprobada',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
    }
    public function enviadasDAC()
    {
        $evidencias = Evidencia::where([['estado','Pendiente'],['nivel',3],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();
        return view('revisor.evidenciasEnviadasDac',["evidencias"=>$evidencias]);   
    }
    /**
     * Modificar campo nivel de la tabla evidencias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aprobarEvidenciaRevisor($id)
    {
        //   Obteniendo los datos actuales de la evidencia.
        $evidencia = Evidencia::find($id);
        //   Cambiando los datos antiguos por los nuevos.
        $evidencia->nivel = 3;
        //   Guardando los cambios.
        $evidencia->save();
        return redirect()->route('colaRevisor')->with('success','Evidencia enviada correctamente a D.A.C.');
    }
    /**
     * Agregar una observación a la evidencia y cambiar el nivel de la evidencia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function observacionRevisor(Request $request, $id)
    {
        //  Validando los datos ingresados.
        $validatedData=$request->validate([
            'observacionRevisor' => 'required|string',
        ]);
        //  Creando la observación en la base de datos.
        $observacion = new Observaciones;
        $observacion->evidencia_id = $id;
        $observacion->observacion = $request->input('observacionRevisor');
        $observacion->user_id = auth()->user()->id;
        $observacion->nivel = 2;    //El nivel en que fue realizada la observación fue revisor.
        $observacion->save();
        //  Enviando la evidencia a profesor.
        $evidencia = Evidencia::find($id);  //Obteniendo los datos actuales de la evidencia. 
        $evidencia->nivel = 1;  //Cambiando el nivel a profesor.
        $evidencia->save();
        return redirect()->route('colaRevisor')->with('success','Observación agregada correctamente. La evidencia volvió al profesor.');
    }
    public function pdf_evidencia_aprobada_rev($id){
        $datos = Formulario::where('formularios.id',$id)
                        ->join('ambito','ambito.id','=','formularios.ambito_id')
                        ->join('alcance','alcance.id','=','formularios.alcance_id')
                        ->join('tipo','tipo.id','=','formularios.tipo_id')
                        ->join('evidencias','evidencias.formulario_id','=','formularios.id')
                        ->join('profesor','evidencias.user_id','=','profesor.user_id')
                        ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                        ->join('departamentos','carreras.codigo_dep','=','departamentos.codigo_dep')
                        ->join('folios','evidencias.folio_id','=','folios.id')
                        ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id','evidencias.created_at','departamentos.nombre_dep','folios.*')
                        ->first();
        //  Calculando totales.
        $total_int = $datos['int_profesores'] + $datos['int_profesionales'];
        $total_int = $total_int + $datos['int_estudiantes'] + $datos['int_autoridades'];
        $total_ext = $datos['ext_profesores'] + $datos['ext_profesionales'];
        $total_ext = $total_ext + $datos['ext_estudiantes'] + $datos['ext_autoridades'];
        $total = $total_int + $total_ext;
        Fpdf::AddPage();
        Fpdf::Image('img/logo_ucm_color.png',10,8,40);
        Fpdf::Image('img/logo_dac.png',160,8,40);
        Fpdf::SetFont('Arial','B',13);
        Fpdf::Cell(30);
        Fpdf::Cell(120,10,utf8_decode('Universidad Católica del Maule'),0,0,'C');
        Fpdf::Ln('5');
        Fpdf::SetFont('Arial','B',8);
        Fpdf::Cell(30);
        Fpdf::Cell(120,10,utf8_decode('Departamento de Aseguramiento de la Calidad'),0,0,'C');
        Fpdf::Ln(20);
        Fpdf::SetFont('Arial','B',13);
        Fpdf::Cell(175,10,utf8_decode('Documento del Sistema de Gestión de Calidad'),0,0,'C');
        Fpdf::Ln(5);
        Fpdf::SetFont('Arial','B',11);
        Fpdf::Cell(180,10,utf8_decode('Registros del Sistema de Gestión de Calidad'),0,0,'C');
        Fpdf::Ln(5);
        Fpdf::Cell(180,10,utf8_decode('Identificación de Registros'),0,0,'C');
        Fpdf::Ln(15);
        Fpdf::Cell(30,7,utf8_decode('NºFolio'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(90,7,utf8_decode($datos['codigo']."-".$datos['numero']),'TBR',0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Fecha de Emisión del Registro'),'TLR',0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(120,7,'','',0,'L',FALSE);
        Fpdf::Cell(0,7,utf8_decode($datos['created_at']),'BLR',0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(120,7,'','',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(30,7,utf8_decode('Título'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos['titulo']),'TBR',0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Ln(7);
        Fpdf::Cell(30,7,utf8_decode('ID'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos['evidencia_id']),'TBR',0,'L',FALSE);  
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Ln(7);
        Fpdf::Cell(30,7,utf8_decode('Fecha realización'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos['fecha_realizacion']),'TBR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(30,7,utf8_decode('Carrera'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos['nombre_car']),'TBR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(30,7,utf8_decode('Departamento'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos['nombre_dep']),'TBR',0,'L',FALSE);
        Fpdf::Ln(7);
    
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(63,7,utf8_decode('Tipo registro'),'TLR',0,'C',FALSE);
        Fpdf::Cell(63,7,utf8_decode('Ámbito'),'TLR',0,'C',FALSE);
        Fpdf::Cell(64,7,utf8_decode('Alcance'),'TLR',0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(63,7,utf8_decode($datos['tipo']),'BLR',0,'C',FALSE);
        Fpdf::Cell(63,7,utf8_decode($datos['ambito']),'BLR',0,'C',FALSE);
        Fpdf::Cell(64,7,utf8_decode($datos['alcance']),'BLR',0,'C',FALSE);
        Fpdf::Ln(16);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Descripción'),'TLR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::MultiCell(0,5,utf8_decode($datos['descripcion']),'BLR','J',FALSE);
        Fpdf::Ln();
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Responsable'),'TLR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        $nombre = $datos['nombre1']." ".$datos['nombre2']." ".$datos['apellido1']." ".$datos['apellido2'];
        Fpdf::MultiCell(0,5,utf8_decode('Nombre: '.$nombre),'BLR','J',FALSE);
        Fpdf::MultiCell(0,5,utf8_decode('R.U.N: '.$datos['run']),'BLR','J',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Asistentes'),1,1,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Internos'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Externos'),1,1,'C',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('Autoridades'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['int_autoridades']),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Autoridades'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['ext_autoridades']),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Estudiantes'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['int_estudiantes']),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Estudiantes'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['ext_estudiantes']),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesionales'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['int_profesionales']),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesionales'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['ext_profesionales']),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesores'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['int_profesores']),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesores'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos['ext_profesores']),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($total_int),1,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($total_ext),1,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(95,7,utf8_decode('Total asistentes'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($total),1,1,'C',FALSE);
        Fpdf::Ln(7);
        $fecha_actual = new Carbon;
        Fpdf::Output('I',"Ev_".$datos['codigo']."-".$datos['numero']."_".$fecha_actual);
        Fpdf::Output();
        exit;
        
    }
}