@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/chat.css')}}"> 

<body>
<div class="container">
<h3 class=" text-center">Mensajería Cloudbucket</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Bandeja</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                </div>
            </div>
          </div>
          <div class="inbox_chat">
          @if($chats)
            @foreach($chats as $chat)
              @if($chat->name != Auth::user()->name)
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"> <img onclick="verPerfil({{$chat->id}})" style=" cursor: pointer; width:44px; height:44px; border-radius: 50%; " src="{{ asset( 'uploads/'.$chat->img)}}" alt="sunil"> </div>
                  <div class="chat_ib" onclick="getMsj({{$chat->id_chat}},{{Auth::user()->id}})" style=" cursor: pointer;">
                    <form id="form{{$chat->id}}" action="{{route('verPerfil')}}" method="post">
                        {{ csrf_field() }}  
                        <input type="hidden" name="id_user" value="{{$chat->id}}">
                    </form>
                    <h5>{{$chat->name}} <span class="chat_date">{{$chat->id_chat}}</span></h5>
                    <p>{{$chat->email}}</p>
                  </div>
                </div>
              </div>
              @endif
            @endforeach
          @endif
          </div>
        </div>
        <div class="mesgs">
        <div id="contenedor" class="msg_history">
        </div>
        <div class="type_msg">
            <div class="input_msg_write">
              <input id="mensaje" type="text" class="write_msg" placeholder="Escribe un mensaje" />
              <button onclick="enviarMsj()" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
              
            </div>
          </div>
        </div>
      </div>
      
     
    </div></div>




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script> 
<script type="text/javascript">
var t = setInterval( autoMsj, 5000 );


function enviarMsj()
{
  var mensaje = document.getElementById("mensaje").value;
  var chat = document.getElementById("idchat").value;
  var token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: '/nuevoMensaje',
    data: {_token:token, mensaje:mensaje, chat:chat},
    type: 'POST',
    success: function(result) {
      $('#mensaje').val('');
      var objDiv = document.getElementById("contenedor");
                objDiv.scrollTop = objDiv.scrollHeight;
    }
 });
  
}
function getMsj(i,usuario)
{
  var token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: '/listaMensajes',
    data: {chat:i},
    type: 'GET',
    success: function(json) {
                $("#contenedor").empty();
                var jason = JSON.stringify(json);
                var htmlMSJ = '<input id="idchat" type="hidden" value="'+i+'">';
                for(j = 0; j < json.lista.length; j++)
                {
                  if(json.lista[j].id_user == usuario)
                  {
                    htmlMSJ = htmlMSJ + '<input id="idusuario" type="hidden" value="{{Auth::user()->id}}"><input id="idchat" type="hidden" value="'+json.lista[j].chat+'"><div class="outgoing_msg"><div class="sent_msg"><p>'+json.lista[j].mensaje+'</p><span class="time_date">' +json.lista[j].created_at+'</span> </div></div>';
                  }
                  else
                  {
                    htmlMSJ = htmlMSJ + '<input id="idusuario" type="hidden" value="{{Auth::user()->id}}"><input id="idchat" type="hidden" value="'+json.lista[j].chat+'"><div class="incoming_msg"><div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+json.lista[j].mensaje+'</p><span class="time_date">' +json.lista[j].created_at+'</span></div></div></div>';
                  }  
                }
                $("#contenedor").append(htmlMSJ);
                var objDiv = document.getElementById("contenedor");
                objDiv.scrollTop = objDiv.scrollHeight;
    }
});
}

function autoMsj()
{
  var i = document.getElementById('idchat').value;
  var usuario = document.getElementById('idusuario').value;
  var token = $('meta[name="csrf-token"]').attr('content');
  
  $.ajax({
    url: '/listaMensajes',
    data: {chat:i},
    type: 'GET',
    success: function(json) {
                $("#contenedor").empty();
                var jason = JSON.stringify(json);
                var htmlMSJ = '<input id="idchat" type="hidden" value="'+i+'">';
                for(j = 0; j < json.lista.length; j++)
                {
                  if(json.lista[j].id_user == usuario)
                  {
                    htmlMSJ = htmlMSJ + '<input id="idusuario" type="hidden" value="{{Auth::user()->id}}"><input id="idchat" type="hidden" value="'+json.lista[j].chat+'"><div class="outgoing_msg"><div class="sent_msg"><p>'+json.lista[j].mensaje+'</p><span class="time_date">' +json.lista[j].created_at+'</span> </div></div>';
                  }
                  else
                  {
                    htmlMSJ = htmlMSJ + '<input id="idusuario" type="hidden" value="{{Auth::user()->id}}"><input id="idchat" type="hidden" value="'+json.lista[j].chat+'"><div class="incoming_msg"><div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+json.lista[j].mensaje+'</p><span class="time_date">' +json.lista[j].created_at+'</span></div></div></div>';
                  }  
                }
                
                $("#contenedor").append(htmlMSJ);
    }
});
}


  function verPerfil(i)
  {
    document.getElementById("form"+i).submit();
  }
   

</script>

  
@endsection