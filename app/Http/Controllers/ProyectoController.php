<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habilidad_Proyecto;
use App\Area;
use App\Habilidad;
use App\Proyecto;
use App\Progreso;
use App\Liberar;
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
        $proyecto->estatus = 'Publicado';
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
    	$proyecto = DB::table('proyecto')->where('usuario', Auth::user()->id)->get();
        $num[] = ['id_proyecto' => 0, 'solicitudes' => 0];
        foreach ($proyecto as $p) 
        {
            $numeroSolicitudes = DB::table('solicitud')->where('id_proyecto',$p->id_proyecto)->count();
            $num[] = ['id_proyecto' => $p->id_proyecto, 'solicitudes' => $numeroSolicitudes];

        }
        $solicitudes = DB::table('solicitud')->join('proyecto', 'proyecto.id_proyecto', '=', 'solicitud.id_proyecto')->select('proyecto.titulo as titulo', 'solicitud.mensaje as mensaje', 'solicitud.limite as limite', 'solicitud.estatus as estatus', 'solicitud.id_proyecto as id_proyecto')->where('id_user',Auth::user()->id)->get();
        $contratos = DB::table('solicitud')->join('contrato', 'contrato.solicitud', '=', 'solicitud.id_solicitud')->join('proyecto', 'proyecto.id_proyecto', '=', 'solicitud.id_proyecto')->select('proyecto.titulo as titulo','contrato.firma_freelancer as firma', 'contrato.id_contrato as id', 'solicitud.id_solicitud as id_solicitud')->where('id_user', Auth::user()->id)->get();
        return view('home')->with(['proyecto' => $proyecto, 'solicitudes' => $solicitudes, 'contratos' => $contratos, 'num' => $num]);
        
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
            $proyectos = DB::table('proyecto')->where('titulo','like',"%".$request->searchName."%")->where('estatus','Publicado')->get();
            
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
        $solicitudes = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.name as username', 'solicitud.mensaje as mensaje', 'solicitud.id_solicitud as id_solicitud', 'solicitud.limite as limite', 'solicitud.id_proyecto as id_proyecto', 'solicitud.id_user as id_user', 'solicitud.estatus as estatus')->where('id_proyecto',$idproyecto)->get();
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
        $proyecto = DB::table('proyecto')->where('usuario', Auth::user()->id)->get();
        $num[] = ['id_proyecto' => 0, 'solicitudes' => 0];
        foreach ($proyecto as $p) 
        {
            $numeroSolicitudes = DB::table('solicitud')->where('id_proyecto',$p->id_proyecto)->count();
            $num[] = ['id_proyecto' => $p->id_proyecto, 'solicitudes' => $numeroSolicitudes];

        }
        $solicitudes = DB::table('solicitud')->join('proyecto', 'proyecto.id_proyecto', '=', 'solicitud.id_proyecto')->select('proyecto.titulo as titulo', 'solicitud.mensaje as mensaje', 'solicitud.limite as limite', 'solicitud.estatus as estatus', 'solicitud.id_proyecto as id_proyecto')->where('id_user',Auth::user()->id)->get();
        $contratos = DB::table('solicitud')->join('contrato', 'contrato.solicitud', '=', 'solicitud.id_solicitud')->join('proyecto', 'proyecto.id_proyecto', '=', 'solicitud.id_proyecto')->select('proyecto.titulo as titulo','contrato.firma_freelancer as firma', 'contrato.id_contrato as id', 'solicitud.id_solicitud as id_solicitud')->where('id_user', Auth::user()->id)->get();
        return view('home')->with(['proyecto' => $proyecto, 'solicitudes' => $solicitudes, 'contratos' => $contratos, 'num' => $num]);
    }

    public function work(Request $request)
    {
        $estatus = 0;
        $progreso = DB::table('progreso')->where('id_proyecto', $request->data)->get();
        foreach($progreso as $p)
        {
            if($p->estatus != 'Terminada')
            {
                $estatus = $estatus + 1;
            }
        }
        if($estatus == 0)
        {
            $pro = Proyecto::find($request->data);
            $pro->estatus = 'Terminado';
            $pro->save();
        }
        $liberar = DB::table('liberar')->where('id_proyecto', $request->data)->get();
        $proyecto = DB::table('proyecto')->where('id_proyecto', $request->data)->get();
        $cliente = DB::table('proyecto')->join('users', 'users.id', '=', 'proyecto.usuario')->select('users.id as id', 'users.name', 'users.image', 'users.email')->where('id_proyecto', $request->data)->get();
        $solicitud = DB::table('solicitud')->join('contrato', 'contrato.solicitud', '=', 'solicitud.id_solicitud')->select('contrato.id_contrato','contrato.pago as pago', 'contrato.fecha_entrega as entrega', 'contrato.penalizacion as penalizacion', 'solicitud.id_solicitud')->where([['id_proyecto', '=', $request->data],['estatus', '=', 'Aceptada']])->get();
        $freelancer = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.id as id','users.name', 'users.image', 'users.email')->where([['id_proyecto', '=', $request->data],['estatus', '=', 'Aceptada']])->get();
        return view('workspace')->with(['liberar'=>$liberar,'estatus' => $estatus,'progreso'=>$progreso,'proyecto' => $proyecto, 'solicitud' => $solicitud, 'freelancer' => $freelancer, 'cliente' => $cliente]);
    }

    public function progreso(Request $request)
    {
        $progreso = Progreso::find($request->id_progreso);
        $progreso->estatus = $request->estatus;
        $progreso->save();
        $proyecto = DB::table('proyecto')->where('id_proyecto', $request->data)->get();
        $progreso = DB::table('progreso')->where('id_proyecto', $request->data)->get();
        $liberar = DB::table('liberar')->where('id_proyecto', $request->data)->get();
        $cliente = DB::table('proyecto')->join('users', 'users.id', '=', 'proyecto.usuario')->select('users.id as id', 'users.name', 'users.image', 'users.email')->where('id_proyecto', $request->data)->get();
        $solicitud = DB::table('solicitud')->join('contrato', 'contrato.solicitud', '=', 'solicitud.id_solicitud')->select('contrato.id_contrato','contrato.pago as pago', 'contrato.fecha_entrega as entrega', 'contrato.penalizacion as penalizacion', 'solicitud.id_solicitud')->where([['id_proyecto', '=', $request->data],['estatus', '=', 'Aceptada']])->get();
        $freelancer = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.id as id','users.name', 'users.image', 'users.email')->where([['id_proyecto', '=', $request->data],['estatus', '=', 'Aceptada']])->get();
        return back()->with(['liberar'=>$liberar,'progreso'=>$progreso,'proyecto' => $proyecto, 'solicitud' => $solicitud, 'freelancer' => $freelancer, 'cliente' => $cliente]);
    }

    public function liberar(Request $request)
    {
        $liberar = new liberar;
        $liberar->id_user_libera = Auth::user()->id;
        $liberar->id_user_liberado = $request->id_freelancer;
        $liberar->valoracion = $request->valoracion;
        $liberar->comentario = $request->comentario;
        $liberar->id_proyecto = $request->data;
        $liberar->save();
        $conteo = DB::table('liberar')->where('id_user_liberado', $request->id_freelancer)->count();
        $sum = DB::table('liberar')->where('id_user_liberado', $request->id_freelancer)->sum('valoracion');
        DB::table('users')->where('id', $request->id_freelancer)->update(['valoracion' => $sum/$conteo]);
        $estatus = 0;
        $liberar = DB::table('liberar')->where('id_proyecto', $request->data)->get();
        $proyecto = DB::table('proyecto')->where('id_proyecto', $request->data)->get();
        $progreso = DB::table('progreso')->where('id_proyecto', $request->data)->get();
        $cliente = DB::table('proyecto')->join('users', 'users.id', '=', 'proyecto.usuario')->select('users.id as id', 'users.name', 'users.image', 'users.email')->where('id_proyecto', $request->data)->get();
        $solicitud = DB::table('solicitud')->join('contrato', 'contrato.solicitud', '=', 'solicitud.id_solicitud')->select('contrato.id_contrato','contrato.pago as pago', 'contrato.fecha_entrega as entrega', 'contrato.penalizacion as penalizacion', 'solicitud.id_solicitud')->where([['id_proyecto', '=', $request->data],['estatus', '=', 'Aceptada']])->get();
        $freelancer = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.id as id','users.name', 'users.image', 'users.email')->where([['id_proyecto', '=', $request->data],['estatus', '=', 'Aceptada']])->get();
        return back()->with(['liberar'=>$liberar,'estatus' => $estatus,'progreso'=>$progreso,'proyecto' => $proyecto, 'solicitud' => $solicitud, 'freelancer' => $freelancer, 'cliente' => $cliente]);
    }
}
