<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habilidad_Proyecto;
use App\Area;
use App\Habilidad;
use App\Proyecto;
use App\Progreso;
use App\Solicitud;
use Illuminate\Support\Facades\Redirect;
use Session; 
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;

class SolicitudController extends Controller
{
    public function subir(Request $request)
    {
        $solicitud = new solicitud;
        $solicitud->mensaje = $request->mensaje;
        $solicitud->limite = $request->limite;
        $solicitud->id_proyecto = $request->id_proyecto;
        $solicitud->id_user = Auth::user()->id;
        $solicitud->save();
        $id = Auth::user()->id;
        $idproyecto = $request->id_proyecto;
        $progresos = DB::table('progreso')->where('id_proyecto',$idproyecto)->get();
        $solicitudes = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.name as username', 'solicitud.mensaje as mensaje', 'solicitud.limite as limite', 'solicitud.id_proyecto as id_proyecto', 'solicitud.id_user as id_user')->where('id_proyecto',$idproyecto)->get();
        $etiquetas = DB::table('habilidad_proyecto')->join('habilidad', 'habilidad_proyecto.id_habilidad', '=', 'habilidad.id_habilidad')
        ->select('habilidad.titulo as nombre')->where('id_proyecto', $idproyecto)->get();
     //   $propuestauser = DB::table('propuesta')->select('*')->where([['user','=',$id],['proyecto','=',$idproyecto]])->get();
        $detalles = DB::table('proyecto')->join('areas','proyecto.area','=','areas.id_area')->join('users','proyecto.usuario','=','users.id')
        ->select('proyecto.id_proyecto as id_proyecto','proyecto.titulo as titulo', 'proyecto.descripcion as descripcion', 'proyecto.presupuesto as presupuesto', 'proyecto.anexo as anexo', 'proyecto.estatus as estatus', 'proyecto.tiempo as tiempo', 'areas.titulo as area', 'users.name as nombre')
        ->where('proyecto.id_proyecto',$idproyecto)->get();
        return back()->with(['solicitudes' => $solicitudes, 'detalles'=>$detalles,'etiquetas'=>$etiquetas, 'progresos' => $progresos]);

    }
}
