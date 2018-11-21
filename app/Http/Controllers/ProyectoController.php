<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habilidad_Proyecto;
use App\Area;
use App\Habilidad;
use App\Proyecto;
use App\Progreso;
use Illuminate\Support\Facades\Redirect;
use Session; 
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;

class ProyectoController extends Controller
{
    public function subir(Request $request){
        $proyecto = new proyecto;
    	$proyecto->titulo = $request->titulo;
    	$proyecto->area = $request->area;
    	$proyecto->descripcion = $request->descripcion; 
    	$proyecto->presupuesto = $request->presupuesto;
        $proyecto->tiempo = $request->tiempo;
        $proyecto->usuario = Auth::user()->id;
        $path = 'anexos';
        if($request->hasFile('anexo'))
        {
            $NombreAnexo = $request->file('anexo')->getClientOriginalName();
            $file = $request->file('anexo');
            $file->move($path, $file->getClientOriginalName());
            $proyecto->anexo = $NombreAnexo;
        }
        else
        {
            $proyecto->anexo = NULL;
        }

        $proyecto->save();
        $idproyecto = $proyecto->id_proyecto;
        $conteo = count($request->nombre_progreso);

        for($i = 0; $i < $conteo; $i++)
        {
            $progreso = new progreso;
            $progreso->nombre_progreso =  $request->nombre_progreso[$i];
            $progreso->descripcion =  $request->descripcionP[$i];
            $progreso->fecha_entrega =  $request->fecha_entrega[$i];
            $progreso->fecha_prorroga =  $request->fecha_prorroga[$i];
            $progreso->pago_pct =  $request->presupuesto/$request->entregas;
            $progreso->id_proyecto =  $idproyecto;
            $progreso->save();
        }
            $arrayetiquetas = Input::get('etiquetas');
            if($arrayetiquetas!=null){
                foreach($arrayetiquetas as $id_etiqueta){
                $etiqueta = new habilidad_proyecto;
                $etiqueta->id_proyecto = $idproyecto;
                $etiqueta->habilidad = $id_etiqueta;
                $etiqueta->save();
            }
        } 
    	return view('home');
        
    }   

    public function cargarvista(){
        $etiquetas = habilidad::all();
        $area = area::all();
        return view('proyecto')->with('etiquetas',$etiquetas)->with('area', $area);
    }

    public function SearchProject(){
        $proyecto = proyecto::find('');
        $etiquetas = habilidad::all();
        return view('buscarproyecto')->with('proyecto',$proyecto)->with('etiquetas',$etiquetas);
    }

    public function ShowProject(Request $request){
        $etiquetas = habilidad::all();
        
        if($request->habilidades == ''){
            $proyectos = DB::table('proyecto')->where('titulo','like',"%".$request->searchName."%")->get();
            
            return view('buscarproyecto')->with('proyecto',$proyectos)->with('etiquetas',$etiquetas);
        }
        else{ 
            $proyectos = DB::table('habilidad_proyecto')
            ->join('proyecto','habilidad_proyecto.id_proyecto','=','proyecto.id_proyecto')
            ->join('habilidad','habilidad_proyecto.id_habilidad','=','habilidad.id_habilidad')->select('proyecto.*')
            ->where([['proyecto.titulo','like',"%".$request->searchName."%"],['habilidad.id_habilidad',$request->habilidades]])
            ->get();

            return view('buscarproyecto')->with('proyecto',$proyectos)->with('etiquetas',$etiquetas);
        }
    }        

    public function projectdetailsfreelancer(Request $request){
        $id = Auth::user()->id;
        $idproyecto = $request->data;
        $progresos = DB::table('progreso')->where('id_proyecto',$idproyecto)->get();
        $solicitudes = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.name as username', 'solicitud.mensaje as mensaje', 'solicitud.limite as limite', 'solicitud.id_proyecto as id_proyecto', 'solicitud.id_user as id_user')->where('id_proyecto',$idproyecto)->get();
        $etiquetas = DB::table('habilidad_proyecto')->join('habilidad', 'habilidad_proyecto.id_habilidad', '=', 'habilidad.id_habilidad')
        ->select('habilidad.titulo as nombre')->where('id_proyecto', $idproyecto)->get();
        $solicituduser = DB::table('solicitud')->select('*')->where([['id_user','=',$id],['id_proyecto','=',$idproyecto]])->get();
        $detalles = DB::table('proyecto')->join('areas','proyecto.area','=','areas.id_area')->join('users','proyecto.usuario','=','users.id')
        ->select('proyecto.id_proyecto as id_proyecto','proyecto.titulo as titulo', 'proyecto.descripcion as descripcion', 'proyecto.presupuesto as presupuesto', 'proyecto.anexo as anexo', 'proyecto.estatus as estatus', 'proyecto.tiempo as tiempo', 'areas.titulo as area', 'users.name as nombre')
        ->where('proyecto.id_proyecto',$idproyecto)->get();
        return view('detallesproyecto',['solicitudes' => $solicitudes, 'detalles'=>$detalles,'etiquetas'=>$etiquetas, 'progresos' => $progresos, 'solicituduser' => $solicituduser]);
    }

    public function download(Request $request){
        $archivo = $request->archivo;
        $direccionImagen=base_path().'/public/anexos/'; 
        $pathToFile = $direccionImagen.$archivo;
        return response()->download($pathToFile);
    }

    public function index()
    {
        $proyecto = DB::table('proyecto')->where('usuario',Auth::user()->id)->get();
        return view('home')->with('proyecto',$proyecto);
    }
}
