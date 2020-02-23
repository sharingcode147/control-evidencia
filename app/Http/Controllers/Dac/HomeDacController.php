<?php

namespace App\Http\Controllers\Dac;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Folio;
use App\Mail\SistemaEvidenciasInfo;
use Mail;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Fpdf;

class HomeDacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dac.home');
    }

    public function colaDac(){
        //Obteniendo los datos sobre evidencias.
        $evidencias = Evidencia::where('estado','Pendiente')
                                ->where('nivel','3')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion','evidencias.id as evidencia_id')
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
            $evidencia->dias = $fecha_actual->diffInDays($fecha);
        }
        return view('dac.evCursoDac',["evidencias"=>$evidencias]);

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
                            ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car')
                            ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id')
                            ->get();

            $observaciones = Observaciones::where('evidencia_id',$id)
                                        ->join('users','users.id','=','observaciones.user_id')
                                        ->select('observaciones.*','users.name','users.email')
                                        ->orderBy('observaciones.created_at','desc')
                                        ->get();
            return view('dac.formularioDac',["datos"=>$datos,"observaciones"=>$observaciones]);
    
        }
    }

    public function showHisAprob($id)
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
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car')
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id')
                                ->get();

            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('dac.evidenciaFormulario',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
    }


      /**
     * Modificar campo nivel de la tabla evidencias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aprobarEvidenciaDac($id)
    {
        //   Obteniendo los datos actuales de la evidencia.
        $evidencia = Evidencia::find($id);
        if($evidencia->estado == "Cancelada"){
            //  El profesor canceló la evidencia mientras se revisaba.
            return redirect()->route('colaDac')->with('error','La evidencia no ha sido guardada como aprobada, ya que fue cancelada por profesor.');
        }else{
            //   Cambiando los datos antiguos por los nuevos.
            $evidencia->estado = 'Finalizada';
            //   Guardando los cambios.
            $foli = new Folio();
            $foli->codigo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYXZ"),0,5);
            $foli->numero = $evidencia->id;
            $foli->save();
            $evidencia->folio_id = $foli->id;
            $evidencia->save();

            try{
                $email = User::where('id',$evidencia->user_id)->select('email')->first();
                Mail::to($email)->send(new SistemaEvidenciasInfo($id,"Aprobado","D.A.C.","Proceso terminado"));
            }catch(Exception $e){}

            return redirect()->route('colaDac')->with('success','Evidencia aprobada correctamente.');
        }
        
    }

    /**
     * Agregar una observación a la evidencia y cambiar el nivel de la evidencia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function observacionDac(Request $request, $id)
    {
        //  Validando los datos ingresados.
        $validatedData=$request->validate([
            'observacionDac' => 'required|string',
        ]);

        $evidencia = Evidencia::find($id);  //Obteniendo los datos actuales de la evidencia. 
        if($evidencia->estado == "Cancelada"){
            //  El profesor canceló la evidencia mientras se revisaba.
            return redirect()->route('colaDac')->with('error','No se agregaron las observaciones, ya que la evidencia fue cancelada por profesor.');
        }else{
            //  Creando la observación en la base de datos.
            $observacion = new Observaciones;
            $observacion->evidencia_id = $id;
            $observacion->observacion = $request->input('observacionDac');
            $observacion->user_id = auth()->user()->id;
            $observacion->nivel = 3;    //El nivel en que fue realizada la observación fue Dac.
            $observacion->save();

            //  Enviando la evidencia a profesor.
            $evidencia->nivel = 1;  //Cambiando el nivel a profesor.
            $evidencia->save();
            
            try{
                $email = User::where('id',$evidencia->user_id)->select('email')->first();
                Mail::to($email)->send(new SistemaEvidenciasInfo($id,"Rechazado","D.A.C.","Profesor"));
            }catch(Exception $e){}

            return redirect()->route('colaDac')->with('success','Observación agregada correctamente. La evidencia volvió al profesor.');
        }

        
    }

    public function pdf_evidencia_aprobada_dac($id){

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
        $total_int = $datos->int_profesores + $datos->int_profesionales;
        $total_int = $total_int + $datos->int_estudiantes + $datos->int_autoridades;

        $total_ext = $datos->ext_profesores + $datos->ext_profesionales;
        $total_ext = $total_ext + $datos->ext_estudiantes + $datos->ext_autoridades;
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
        Fpdf::Cell(90,7,utf8_decode($datos->codigo."-".$datos->numero),'TBR',0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Fecha de Emisión del Registro'),'TLR',0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(120,7,'','',0,'L',FALSE);
        Fpdf::Cell(0,7,utf8_decode($datos->created_at),'BLR',0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(120,7,'','',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(30,7,utf8_decode('Título'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos->titulo),'TBR',0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Ln(7);
        Fpdf::Cell(30,7,utf8_decode('ID'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos->evidencia_id),'TBR',0,'L',FALSE);  
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Ln(7);
        Fpdf::Cell(30,7,utf8_decode('Fecha realización'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos->fecha_realizacion),'TBR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(30,7,utf8_decode('Carrera'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos->nombre_car),'TBR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(30,7,utf8_decode('Departamento'),'TBL',0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(0,7,utf8_decode($datos->nombre_dep),'TBR',0,'L',FALSE);
        Fpdf::Ln(7);
    
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(63,7,utf8_decode('Tipo registro'),'TLR',0,'C',FALSE);
        Fpdf::Cell(63,7,utf8_decode('Ámbito'),'TLR',0,'C',FALSE);
        Fpdf::Cell(64,7,utf8_decode('Alcance'),'TLR',0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(63,7,utf8_decode($datos->tipo),'BLR',0,'C',FALSE);
        Fpdf::Cell(63,7,utf8_decode($datos->ambito),'BLR',0,'C',FALSE);
        Fpdf::Cell(64,7,utf8_decode($datos->alcance),'BLR',0,'C',FALSE);

        Fpdf::Ln(16);


        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Descripción'),'TLR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::MultiCell(0,5,utf8_decode($datos->descripcion),'BLR','J',FALSE);
        Fpdf::Ln();

        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Responsable'),'TLR',0,'L',FALSE);
        Fpdf::Ln(7);
        Fpdf::SetFont('Arial', '', 9);
        $nombre = $datos->nombre1." ".$datos->nombre2." ".$datos->apellido1." ".$datos->apellido2;
        Fpdf::MultiCell(0,5,utf8_decode('Nombre: '.$nombre),'BLR','J',FALSE);
        Fpdf::MultiCell(0,5,utf8_decode('R.U.N: '.$datos->run),'BLR','J',FALSE);
        Fpdf::Ln(7);

        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,7,utf8_decode('Asistentes'),1,1,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Internos'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Externos'),1,1,'C',FALSE);


        Fpdf::Cell(47.5,7,utf8_decode('Autoridades'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_autoridades),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Autoridades'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_autoridades),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Estudiantes'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_estudiantes),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Estudiantes'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_estudiantes),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesionales'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_profesionales),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesionales'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_profesionales),0,1,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesores'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_profesores),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(47.5,7,utf8_decode('Profesores'),0,0,'L',FALSE);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_profesores),0,1,'L',FALSE);
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

        Fpdf::Output('I',"Ev_".$datos->codigo."-".$datos->numero."_".$fecha_actual);
        Fpdf::Output();
        exit;
        
    }
}


