<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\Mensaje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function show()
    {
        $id = Auth::user()->id;
        $chats1 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_b')->select('users.id as id','users.image as img','users.email as email','chat.id_user_b as id_user_b', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_a', $id)->orWhere('id_user_b', $id)->get();
        $chats2 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_a')->select('users.id as id','users.image as img','users.email as email','chat.id_user_a as id_user_a', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_b', $id)->orWhere('id_user_a', $id)->get();
        //return view('chat')->with(['chats' => $chats]);
        $merged = $chats1->merge($chats2);

        $chats = $merged->all();
        return view('chat')->with(['chats' => $chats]);
    }

    public function nuevoMensaje(Request $request)
    {
        $mensaje = new mensaje;
        $mensaje->chat = $request->chat;
        $mensaje->id_user = Auth::user()->id;
        $mensaje->mensaje = $request->mensaje;
        $mensaje->leido = false;
        $mensaje->save();
    }

    public function listaMensajes(Request $request)
    {
        $lista = DB::table('mensaje')->where('chat', '=', $request->chat)->get();
        return array('lista' => $lista);
    }

    public function crear(Request $request)
    {
        $id = Auth::user()->id;

        $condicionAB = DB::table('chat')->select('*')->where([['id_user_a','=',$id],['id_user_b','=',$request->id_user]])->get();
        $condicionBA = DB::table('chat')->select('*')->where([['id_user_b','=',$id],['id_user_a','=',$request->id_user]])->get();
        if(!$condicionAB->isEmpty())
        {
            $chats1 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_b')->select('users.id as id','users.image as img','users.email as email','chat.id_user_b as id_user_b', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_a', $id)->orWhere('id_user_b', $id)->get();
                $chats2 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_a')->select('users.id as id','users.image as img','users.email as email','chat.id_user_a as id_user_a', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_b', $id)->orWhere('id_user_a', $id)->get();
                //return view('chat')->with(['chats' => $chats]);
                $merged = $chats1->merge($chats2);
                $chats = $merged->all();
                return view('chat')->with(['chats' => $chats]);
        }
        else
        {
            if(!$condicionBA->isEmpty())
            {
                $chats1 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_b')->select('users.id as id','users.image as img','users.email as email','chat.id_user_b as id_user_b', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_a', $id)->orWhere('id_user_b', $id)->get();
                $chats2 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_a')->select('users.id as id','users.image as img','users.email as email','chat.id_user_a as id_user_a', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_b', $id)->orWhere('id_user_a', $id)->get();
                //return view('chat')->with(['chats' => $chats]);
                $merged = $chats1->merge($chats2);
                $chats = $merged->all();
                return view('chat')->with(['chats' => $chats]);
            }
            else
            {
                $chat = new chat;
                $chat->id_user_a = $id;
                $chat->id_user_b = $request->id_user;
                $chat->save();
                $chats1 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_b')->select('users.id as id','users.image as img','users.email as email','chat.id_user_b as id_user_b', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_a', $id)->orWhere('id_user_b', $id)->get();
                $chats2 = DB::table('chat')->join('users', 'users.id', '=', 'chat.id_user_a')->select('users.id as id','users.image as img','users.email as email','chat.id_user_a as id_user_a', 'chat.id_chat as id_chat', 'users.name as name')->where('id_user_b', $id)->orWhere('id_user_a', $id)->get();
                //return view('chat')->with(['chats' => $chats]);
                $merged = $chats1->merge($chats2);
                $chats = $merged->all();
                return view('chat')->with(['chats' => $chats]);
            }
        }
    }
}
