<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
class EncuestaController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');   
    }

    public function index()
    {   
        $id_empleado=Auth::user()->id_empleado;
        $id_company=Auth::user()->id_company;
        $encuestas=DB::table('encuesta_im as t1')
        ->selectraw('t1.imagen, t1.id as id_encuesta')
        ->join(DB::raw('(SELECT id_empleado,id_encuesta_im,enabled from encuesta_im_empleado where id_empleado='.$id_empleado.') t2')
        ,'t2.id_encuesta_im','t1.id')
        ->whereraw('t1.id_company = '.$id_company)
        ->whereraw('t1.enabled = "true" ')
        ->whereraw('t2.enabled = "true" ')
        ->whereraw('t1.fecha_vencimiento <= DATE(NOW())')
        ->orderby('t1.fecha_vencimiento','ASC')
        ->get();
        for ($i=0; $i < count($encuestas); $i++) { 
            $informacion=DB::table('encuesta_im as t1')
            ->selectraw('t1.titulo,t1.fecha_vencimiento,
            ifnull(t2.cuenta,0) as cuenta')
            ->join(DB::raw('(select id_empleado,id_encuesta_im,cuenta from encuesta_im_empleado where id_empleado='.$id_empleado.')t2'),
            't2.id_encuesta_im','t1.id')
            ->whereraw('t1.id_company = '.$id_company)
            ->whereraw('t1.id='.$encuestas[$i]->id_encuesta)
            ->get();
            /* agrego la informacion de la encuesta */
            $encuestas[$i]->informacion=$informacion;
        }
        /* dd($encuestas); */

        
        
        return view('encuestas.index',compact('encuestas'));
    }
    public function show($id_encuesta)
    {
        $encuesta= Encuesta::findOrFail($id_encuesta);
        $preguntas=DB::table('encuesta_im_detalle')
        ->selectraw('id as id_encuesta_im_detalle,id_tipo,titulo,enunciado')
        ->where('id_encuesta_im',$id_encuesta)
        ->orderby('orden','asc')
        ->get();
        $imagenes=DB::table('encuesta_im_detalle_item')
        ->selectraw('imagen')
        ->where('id_encuesta_im_detalle',$id_encuesta)
        ->orderby('orden','asc')
        ->get();
        $textos=DB::table('encuesta_im_detalle_item')
        ->selectraw('texto')
        ->where('id_encuesta_im_detalle',$id_encuesta)
        ->orderby('orden','asc')
        ->get();
        
        return view('encuestas.show',compact('encuesta','preguntas','imagenes','textos'));
    }
}
