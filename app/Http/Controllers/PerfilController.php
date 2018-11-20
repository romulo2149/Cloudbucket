<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Certificacion;
use App\Certificacion_Freelancer;
use App\Habilidad;
use App\Habilidad_Freelancer;
use App\Idioma;
use App\Idioma_Freelancer;
use App\Informacion_Academica;
use App\Informacion_Laboral;

class PerfilController extends Controller
{
    public function perfil()
    {
        $id = Auth::user()->id;
        $infousuario = DB::table('users')->where('id', $id)->first();
        $idiomas = DB::table('users')  
                    ->join('idioma_freelancer', 'users.id', '=', 'idioma_freelancer.id_idioma_freelancer')
                    ->join('idioma', 'idioma_freelancer.id_idioma_freelancer', '=', 'idioma.id_idioma')
                    ->select('users.id as usuario', 'idioma.idioma as idioma', 'idioma_freelancer.id_idioma_freelancer as id')
                    ->where('users.id', $id)
                    ->get();       
        $certificaciones = DB::table('users')  
                    ->join('certificacion_freelancer', 'users.id', '=', 'certificacion_freelancer.id_certificacion_freelancer')
                    ->join('certificacion', 'certificacion.id_certificacion', '=', 'certificacion_freelancer.id_certificacion_freelancer')
                    ->select('users.id as usuario', 'certificacion.nombre as nombre', 'certificacion.compañia as compañia', 'certificacion_freelancer.id_certificacion_freelancer as id')
                    ->where('users.id', $id)
                    ->get();  
        $informacionAcademica = DB::table('informacion_academica')->select('*')->where('id_user',$id)->get();                  
        $informacionLaboral = DB::table('informacion_laboral')->select('*')->where('id_user',$id)->get(); 
        $habilidades = DB::table('users')
            ->join('habilidad_freelancer', 'users.id', '=', 'habilidad_freelancer.user')
            ->join('habilidad', 'habilidad_freelancer.habilidad', '=', 'habilidad.id_habilidad')
            ->select('users.id as usuario', 'habilidad.titulo as titulo', 'habilidad_freelancer.id_habilidad as id')
            ->where('users.id', $id)
            ->get();
        $habilidad = habilidad::all();         
        return view('perfil',['informacionusuario'=>$infousuario,
                                'idiomas'=>$idiomas,
                                'certificaciones'=>$certificaciones,
                                'informacionAcademica'=>$informacionAcademica,
                                'informacionLaboral'=>$informacionLaboral,
                                'habilidades'=>$habilidades,
                                'habilidad'=>$habilidad
                                ]);
    }

    public function perfilFreelancer(Request $request)
    {
        $id = $request->id_user;
        $infousuario = DB::table('users')->where('id', $id)->first();
        $idiomas = DB::table('users')  
                    ->join('idioma_freelancer', 'users.id', '=', 'idioma_freelancer.id_idioma_freelancer')
                    ->join('idioma', 'idioma_freelancer.id_idioma_freelancer', '=', 'idioma.id_idioma')
                    ->select('users.id as usuario', 'idioma.idioma as idioma', 'idioma_freelancer.id_idioma_freelancer as id')
                    ->where('users.id', $id)
                    ->get();       
        $certificaciones = DB::table('users')  
                    ->join('certificacion_freelancer', 'users.id', '=', 'certificacion_freelancer.id_certificacion_freelancer')
                    ->join('certificacion', 'certificacion.id_certificacion', '=', 'certificacion_freelancer.id_certificacion_freelancer')
                    ->select('users.id as usuario', 'certificacion.nombre as nombre', 'certificacion.compañia as compañia', 'certificacion_freelancer.id_certificacion_freelancer as id')
                    ->where('users.id', $id)
                    ->get();  
        $informacionAcademica = DB::table('informacion_academica')->select('*')->where('id_user',$id)->get();                  
        $informacionLaboral = DB::table('informacion_laboral')->select('*')->where('id_user',$id)->get(); 
        $habilidades = DB::table('users')
            ->join('habilidad_freelancer', 'users.id', '=', 'habilidad_freelancer.user')
            ->join('habilidad', 'habilidad_freelancer.habilidad', '=', 'habilidad.id_habilidad')
            ->select('users.id as usuario', 'habilidad.titulo as titulo', 'habilidad_freelancer.id_habilidad as id')
            ->where('users.id', $id)
            ->get();
        $habilidad = habilidad::all();         
        return view('perfil',['informacionusuario'=>$infousuario,
                                'idiomas'=>$idiomas,
                                'certificaciones'=>$certificaciones,
                                'informacionAcademica'=>$informacionAcademica,
                                'informacionLaboral'=>$informacionLaboral,
                                'habilidades'=>$habilidades,
                                'habilidad'=>$habilidad
                                ]);
    }

    public function guardarImagen(Request $request)
    {   
        /**
        * Aqui se hace la validacion de imagen
        *
        * Solo permite jpeg,png,jpg,bmp,tiff y gif
        *
        **/
        $this->validate($request, [
        'imagen' => 'mimes:jpeg,png,bmp,tiff |max:4096',
        ],
        $messages = [
            'required' => 'The :attribute field is required.',
            'mimes' => 'Solo se permiten imagenes en este campo. Formatos jpeg, png, bmp,tiff son aceptados. Max:4MB'
        ]
        );
        $id = Auth::user()->id;
        /**
        * Aqui se hace la insercion a la BD y a la carpeta public/uploads
        *
        * En el .gitignore omitimos los cambios a esta carpeta
        *
        **/     
        $direccionImagen=base_path().'/public/uploads/';        
        $IMAGEN = "";
        if($request->hasFile('imagen'))
        {
            $IMAGEN = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move($direccionImagen, $IMAGEN);
        }else{
            $nombreImagen = NULL;
        }
        DB::table('users')->where('id',$id)->update([
            'image' => $IMAGEN,            
        ]);           
        $information = DB::table('users')->select('*')->where('id',$id)->first();         
        return redirect()->action('PerfilController@perfil',['informacionusuario'=>$information]);
    }

    public function cambiarNombre(Request $request)
    {
        $id = Auth::user()->id;
        DB::table('users')->where('id',$id)->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos           
        ]);
        $information = DB::table('users')->select('*')->where('id',$id)->first();         
        return redirect()->action('PerfilController@perfil',['informacionusuario'=>$information]);
    }

    public function informacionAcademica(Request $request)
    {                     
        $id = Auth::user()->id;  
        DB::table('informacion_academica')->insert([
            'nivel' => $request->nivel,
            'institucion' => $request->institucionIA,
            'fecha_inicio' => $request->Ainicio,
            'fecha_fin' => $request->Atermino,
            'id_user' => $id
        ]);    
        $informacionAcademica = DB::table('informacion_academica')->select('*')->where('id_user',$id)->get();          
        return redirect()->action('PerfilController@perfil',['informacionAcademica'=>$informacionAcademica]);  
    }

    public function deleteInformacionAcademica(Request $request, $idInformacionAcademica)
    {                     
        $id = Auth::user()->id;  
        DB::table('informacion_academica')->where('id_laboral', $idInformacionAcademica)->delete();
        $informacionAcademica = DB::table('informacion_academica')->select('*')->where('id_user',$id)->get();          
        return redirect()->action('PerfilController@perfil',['informacionAcademica'=>$informacionAcademica]);  
    }

    public function editInformacionAcademica(Request $request)
    {                     
        $id = Auth::user()->id;               
        DB::table('informacion_academica')->where('id_laboral',$request->idInformacionAcademicaM)->update([
            'nivel' => $request->nivelM,
            'institucion' => $request->institucionMIA,
            'fecha_inicio' => $request->fechainicioMIA,
            'fecha_fin' => $request->fechafinMIA,
        ]);
        $informacionAcademica = DB::table('informacion_academica')->select('*')->where('id_user',$id)->get();             
        return redirect()->action('PerfilController@perfil',['informacionAcademica'=>$informacionAcademica]);  
    }

    public function informacionLaboral(Request $request)
    {                     
        $id = Auth::user()->id;  
        DB::table('informacion_laboral')->insert([
            'cargo' => $request->cargo,
            'institucion' => $request->institucionIL,
            'fecha_inicio' => $request->AinicioIL,
            'fecha_fin' => $request->AterminoIL,
            'id_user' => $id
        ]);    
        $informacionLaboral = DB::table('informacion_laboral')->select('*')->where('id_user',$id)->get();          
        return redirect()->action('PerfilController@perfil',['informacionLaboral'=>$informacionLaboral]);  
    }

    public function deleteInformacionLaboral(Request $request,$idInformacionLaboral)
    {                     
        $id = Auth::user()->id;  
        DB::table('informacion_laboral')->where('id_laboral', $idInformacionLaboral)->delete();
        $informacionLaboral = DB::table('informacion_laboral')->select('*')->where('id_user',$id)->get();          
        return redirect()->action('PerfilController@perfil',['informacionLaboral'=>$informacionLaboral]);  
    }

    public function editInformacionLaboral(Request $request)
    {                     
        $id = Auth::user()->id;               
        DB::table('informacion_laboral')->where('id_user',$request->idInformacionLaboralM)->update([
            'cargo' => $request->cargoM,
            'institucion' => $request->institucionMIL,
            'fecha_inicio' => $request->fechainicioMIL,
            'fecha_fin' => $request->fechafinMIL,
        ]);
        $informacionLaboral = DB::table('informacion_laboral')->select('*')->where('id_user',$id)->get();          
        return redirect()->action('PerfilController@perfil',['informacionLaboral'=>$informacionLaboral]);  
    }

    public function saveSalary(Request $request)
    {
        $id = Auth::user()->id;
        DB::table('users')->where('id',$id)->update([
            'salario_hora' => $request->sueldo           
        ]);
        $information = DB::table('users')->select('*')->where('id',$id)->first();         
        return redirect()->action('PerfilController@perfil',['informacionusuario'=>$information]);
    }

    public function savePhone(Request $request)
    {
        $id = Auth::user()->id;
        DB::table('users')->where('id',$id)->update([
            'telefono' => $request->phone           
        ]);
        $information = DB::table('users')->select('*')->where('id',$id)->first();         
        return redirect()->action('PerfilController@perfil',['informacionusuario'=>$information]);
    }
}
