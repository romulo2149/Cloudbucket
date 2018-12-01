<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habilidad_Proyecto;
use App\Area;
use App\Habilidad;
use App\Proyecto;
use App\Contrato;
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
        $solicituduser = DB::table('solicitud')->select('*')->where([['id_user','=',$id],['id_proyecto','=',$idproyecto]])->get();
        $detalles = DB::table('proyecto')->join('areas','proyecto.area','=','areas.id_area')->join('users','proyecto.usuario','=','users.id')
        ->select('proyecto.id_proyecto as id_proyecto','proyecto.titulo as titulo', 'proyecto.descripcion as descripcion', 'proyecto.presupuesto as presupuesto', 'proyecto.anexo as anexo', 'proyecto.estatus as estatus', 'proyecto.tiempo as tiempo', 'areas.titulo as area', 'users.name as nombre')
        ->where('proyecto.id_proyecto',$idproyecto)->get();
        return back()->with(['solicituduser' => $solicituduser, 'solicitudes' => $solicitudes, 'detalles'=>$detalles,'etiquetas'=>$etiquetas, 'progresos' => $progresos]);

    }

    public function eliminar(Request $request)
    {
        $solicitud = Solicitud::find($request->id_solicitud);
        $solicitud->delete();
        $id = Auth::user()->id;
        $idproyecto = $request->id_proyecto;
        $progresos = DB::table('progreso')->where('id_proyecto',$idproyecto)->get();
        $solicitudes = DB::table('solicitud')->join('users', 'users.id', '=', 'solicitud.id_user')->select('users.name as username', 'solicitud.mensaje as mensaje', 'solicitud.limite as limite', 'solicitud.id_proyecto as id_proyecto', 'solicitud.id_user as id_user')->where('id_proyecto',$idproyecto)->get();
        $etiquetas = DB::table('habilidad_proyecto')->join('habilidad', 'habilidad_proyecto.id_habilidad', '=', 'habilidad.id_habilidad')
        ->select('habilidad.titulo as nombre')->where('id_proyecto', $idproyecto)->get();
        $solicituduser = DB::table('solicitud')->select('*')->where([['id_user','=',$id],['id_proyecto','=',$idproyecto]])->get();
        $detalles = DB::table('proyecto')->join('areas','proyecto.area','=','areas.id_area')->join('users','proyecto.usuario','=','users.id')
        ->select('proyecto.id_proyecto as id_proyecto','proyecto.titulo as titulo', 'proyecto.descripcion as descripcion', 'proyecto.presupuesto as presupuesto', 'proyecto.anexo as anexo', 'proyecto.estatus as estatus', 'proyecto.tiempo as tiempo', 'areas.titulo as area', 'users.name as nombre')
        ->where('proyecto.id_proyecto',$idproyecto)->get();
        return back()->with(['solicituduser' => $solicituduser, 'solicitudes' => $solicitudes, 'detalles'=>$detalles,'etiquetas'=>$etiquetas, 'progresos' => $progresos]);

    }

    public function crearContrato(Request $request)
    {
        $datosContrato = DB::table('solicitud')->join('proyecto', 'proyecto.id_proyecto', '=', 'solicitud.id_proyecto')->select('proyecto.presupuesto as pago', 'solicitud.id_solicitud as id_solicitud', 'proyecto.titulo as nombre')->where('id_solicitud',$request->id_solicitud)->get();
        return view('contrato')->with(['datosContrato' => $datosContrato]);
    }

    public function subirContrato(Request $request)
    {
        $contrato = new contrato;
        $id = Auth::user()->id;
        $firma = DB::table('users')->select('*')->where([['id','=',$id],['firma','=', $request->firma_cliente]])->get();
        if(!$firma->isEmpty())
        {
            $contrato->solicitud = $request->solicitud;
            $contrato->firma_cliente = $request->firma_cliente;
            $contrato->pago = $request->pago;
            $contrato->fecha_entrega = $request->fecha_entrega;
            $contrato->penalizacion = $request->penalizacion;
            $contrato->leido = 0;
            $contrato->save();
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
        else
        {
            echo 'firma invalida';
        }
    
    }

    public function firmar(Request $request)
    {
        $datosContrato = DB::table('contrato')->where('id_contrato',$request->data)->get();
        return view('firmarcontrato')->with(['datosContrato' => $datosContrato]);
    }

    public function trato(Request $request)
    {
        $id = Auth::user()->id;
        $firma = DB::table('users')->select('*')->where([['id','=',$id],['firma','=', $request->firma_freelancer]])->get();
        $proyecto = DB::table('solicitud')->select('*')->where('id_solicitud', $request->solicitud)->first();
        DB::table('solicitud')->where('id_proyecto',$proyecto->id_proyecto)->update(['estatus' => 'Rechazada']);
        DB::table('solicitud')->where('id_solicitud',$request->solicitud)->update(['estatus' => 'Aceptada']);
        DB::table('proyecto')->where('id_proyecto',$proyecto->id_proyecto)->update(['estatus' => 'En Desarrollo']);
        
        if(!$firma->isEmpty())
        {
            $cont = Contrato::find($request->id_contrato);

            $cont->firma_freelancer = $request->firma_freelancer;

            $cont->save();
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
        else
        {
            echo 'firma incorrecta';
        }
    }
}
