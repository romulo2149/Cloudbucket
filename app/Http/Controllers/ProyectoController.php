<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habilidad_Proyecto;
use App\Area;
use App\Habilidad;
use App\Proyecto;
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
        if($request->hasFile('anexo')){
            $NombreAnexo = $request->file('anexo')->getClientOriginalName();
            $file = $request->file('anexo');
            $file->move($path, $file->getClientOriginalName());
            $proyecto->anexo = $NombreAnexo;
        }
        else{
            $proyecto->anexo = NULL;
        }
        $proyecto->save();
        $idproyecto = $proyecto->id_proyecto;
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
}
