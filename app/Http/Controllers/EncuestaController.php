<?php

namespace App\Http\Controllers;


use App\Models\Encuesta;
use App\Models\Encuesta_im_respuesta;
use App\Models\Encuesta_im_respuesta_detalle;
use App\Models\EncuestaGrupoIm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
class EncuestaController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');   
    }
    public function grupoIndex()
    {
        $id_empleado=Auth::user()->id_empleado;
        $id_company=Auth::user()->id_company;
        $encuestas=DB::table('encuesta_grupo_im as t1')
        ->selectraw('distinct t1.imagen, t1.id as id_encuesta_grupo,t1.texto')
        ->join('encuesta_im as t3','t3.id_encuesta_grupo_im','t1.id')
        ->join(DB::raw('(SELECT id_empleado,id_encuesta_im,enabled from encuesta_im_empleado where id_empleado='.$id_empleado.') t2')
        ,'t2.id_encuesta_im','t3.id')
        ->whereraw('t1.id_company = '.$id_company)  
        ->whereraw('t1.enabled = "true" ')
        ->whereraw('t2.enabled = "true" ')
        ->whereraw('t1.fecha_vencimiento <= DATE(NOW())')
        ->orderby('t1.fecha_vencimiento','ASC')
        ->get();
        return view('encuestas.encuestas',compact('encuestas'));
    }

    public function index($id_encuesta_grupo_im)
    {   
        $texto=EncuestaGrupoIm::findOrFail($id_encuesta_grupo_im);
        $id_empleado=Auth::user()->id_empleado;
        $id_company=Auth::user()->id_company;
        $encuestas=DB::table('encuesta_im as t1')
        ->selectraw('t1.imagen, t1.id as id_encuesta,t1.texto')
        ->join(DB::raw('(SELECT id_empleado,id_encuesta_im,enabled from encuesta_im_empleado where id_empleado='.$id_empleado.') t2')
        ,'t2.id_encuesta_im','t1.id')
        ->whereraw('t1.id_company = '.$id_company)
        ->whereraw('t1.enabled = "true" ')
        ->whereraw('t2.enabled = "true" ')
        ->whereraw('t1.fecha_vencimiento <= DATE(NOW())')
        ->where('t1.id_encuesta_grupo_im',$id_encuesta_grupo_im)
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

        return view('encuestas.index',compact('encuestas','id_encuesta_grupo_im',"texto"));
    }
    public function show($id_encuesta)
    {
        $encuesta= Encuesta::findOrFail($id_encuesta);
        $preguntas=DB::table('encuesta_im_detalle')
        ->selectraw('id as id_encuesta_im_detalle,id_tipo,titulo,enunciado')
        ->where('id_encuesta_im',$id_encuesta)
        ->orderby('orden','asc')
        ->get();
        for ($i=0; $i < count($preguntas); $i++) { 
            if ($preguntas[$i]->id_tipo==4) {
                $textos=DB::table('encuesta_im_detalle_item')
                ->selectraw('texto')
                ->where('id_encuesta_im_detalle',$preguntas[$i]->id_encuesta_im_detalle)
                ->orderby('orden','asc')
                ->get();
                $preguntas[$i]->textos=$textos;
            }
            
        }
        for ($i=0; $i < count($preguntas); $i++) { 
            if ($preguntas[$i]->id_tipo==3) {
                $imagenes=DB::table('encuesta_im_detalle_item')
                ->selectraw('imagen')
                ->where('id_encuesta_im_detalle',$preguntas[$i]->id_encuesta_im_detalle)
                ->orderby('orden','asc')
                ->get();
                $preguntas[$i]->imagenes=$imagenes;
            }
            
        }
        /* $imagenes=DB::table('encuesta_im_detalle_item')
        ->selectraw('imagen')
        ->where('id_encuesta_im_detalle',$id_encuesta)
        ->orderby('orden','asc')
        ->get(); */
        /* $textos=DB::table('encuesta_im_detalle_item')
        ->selectraw('texto')
        ->where('id_encuesta_im_detalle',$id_encuesta)
        ->orderby('orden','asc')
        ->get(); */
        
       
        $radiocount=1;
        $count=1;
        $radiocount2=1;
        $count2=1;
        return view('encuestas.show',compact('encuesta','preguntas','imagenes','textos','radiocount','count'
        ,'radiocount2','count2','id_encuesta'));
    }
    public function store(Request $request)
    {
        $url=$request->root();
        if ($request->ajax()) {
            json_decode($request, true);
            $id_encuesta= $request['p']['id_encuesta_im'];
            $ean = $request['p']['ean'];
            $ruta_foto = $request['p']['ruta_foto'];    
            $longitud = $request['p']['longitud'];    
            $latitud = $request['p']['latitud'];    
            $respuestas = $request['p']['respuestas'];
            json_encode($respuestas,true);

            $encuesta_im_respuesta=new Encuesta_im_respuesta();
            $encuesta_im_respuesta->id_encuesta_im=$id_encuesta;
            $encuesta_im_respuesta->id_empleado=Auth::user()->id_empleado;
            $encuesta_im_respuesta->ean=$ean;
            $encuesta_im_respuesta->ruta_foto=$url. '/photos' . '/' . $ruta_foto;
            $encuesta_im_respuesta->enabled='true';
            $encuesta_im_respuesta->longitud=$longitud;
            $encuesta_im_respuesta->latitud=$latitud;
            $encuesta_im_respuesta->created_at=Carbon::now();
            $encuesta_im_respuesta->updated_at=Carbon::now();
            $encuesta_im_respuesta->save();
            $ultimoregistro=DB::table('encuesta_im_respuesta')
            ->selectraw('max(id) as id_encuesta_im_respuesta')
            ->where('id_empleado',Auth::user()->id_empleado)
            ->get();
            
            foreach ($ultimoregistro as $key) {
                $ultimoregistro= $key->id_encuesta_im_respuesta;
            }

            $detalle_respuesta= new Encuesta_im_respuesta_detalle();
            $detalle_respuesta->id_encuesta_im_respuesta=$ultimoregistro;
            $detalle_respuesta->respuesta=$respuestas;
            $detalle_respuesta->enabled='true';
            $detalle_respuesta->created_at=Carbon::now();
            $detalle_respuesta->updated_at=Carbon::now();
            $detalle_respuesta->save();

            DB::statement('
            update encuesta_im_respuesta_item t1
            inner join (
            select t1.id, @curRank := @curRank + 1, @curRank as ranking
            from (select  distinct  id from encuesta_im_respuesta_item
            where id_encuesta_im_respuesta ='.$ultimoregistro.') as t1
            inner join (SELECT @curRank := 0) t2 on t1.id = t1.id
            order by t1.id) t2
            on t1.id = t2.id
            set t1.orden = t2.ranking
            ');
            return response()->json("Operacion realizada correctamente");

        } 
    }
    public function guardarFoto(Request $request)
    {
        if ($request->ajax()) {
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $formato = substr($file->getClientOriginalName(), -3);
                if (strtolower($formato) == "jpg" || strtolower($formato) == "png") {
                    $name = md5($file->getClientOriginalName()) . '.' . $formato;
                    $file->move(public_path() . '/photos', $name);
                    return response()->json($name);
                } else {
                    return response()->json("No puede este tipo de archivos" . $file->getClientOriginalName());
                }
            }
        }
    }
}
