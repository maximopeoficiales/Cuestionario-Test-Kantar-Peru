<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');   
    }
    public function index()
    {
        return view("admin.index");
    } 
    public function listaEncuestas()
    {
        $encuestas=DB::table('encuesta_im as t1')
        ->selectraw('t1.titulo, t1.id as id_encuesta_im,date(t1.created_at) as fecha_creacion,t1.fecha_vencimiento,
        case when t1.enabled="false" then "Anulado" when now() > fecha_vencimiento then "Terminado"
        else "En proceso" end as estado')
        ->join('encuesta_im_empleado as t2','t2.id','t1.id')
        ->where('t2.id_empleado',Auth::user()->id_empleado)
        ->get();
        
        return view("admin.encuestas",compact('encuestas'));
    } 
    public function show($id_encuesta_im)
    {
        $dato1=DB::table('encuesta_im as t1')
        ->selectraw('t1.titulo, date(t1.created_at) as fecha_creacion')
        ->where('t1.id',$id_encuesta_im)
        ->get();
        $dato2=DB::table('encuesta_im_detalle as t1')
        ->selectraw('count(*) as total_registros')
        ->where('t1.id_encuesta_im',$id_encuesta_im)
        ->get();
        $dato3=DB::table('encuesta_im_empleado as t1')
        ->selectraw('count(distinct id_empleado) as total_encuestadores')
        ->where('t1.id_encuesta_im',$id_encuesta_im)
        ->get();
        $dato4=DB::table('encuesta_im_detalle as t1')
        ->selectraw('count(distinct id_empleado) as total_encuestadores_validos')
        ->where('t1.id_encuesta_im',$id_encuesta_im)
        ->get();
        $dato5=DB::table('encuesta_im as t1')
        ->selectraw('case when enabled = "false" then "Anulado" 
        when now()>= fecha_vencimiento then "Terminado" 
        else "En proceso end as estado"')
        ->where('t1.id_encuesta_im',$id_encuesta_im)
        ->get();

        return view("admin.show",compact('detalle'));
    }  
}
