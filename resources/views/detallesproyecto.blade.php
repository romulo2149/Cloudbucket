@extends('layouts.app')

@section('content')
    @if(!$detalles->isEmpty())
        @foreach($detalles as $detalles)
        <div class="spacing50"></div>
        <div class="container">
        <div class="row"> 
        <div class="col-md-7">
                 <div class="well" style="width:100%;">
                        <h2 class="text-muted">{{$detalles->titulo}}</h2>
                        @foreach($etiquetas as $etiquetas)
                        <span class="label label-default" style="display:inline-block">{{$etiquetas->nombre}}</span>
                        @endforeach
                        <ul>
                            <li><b>Cliente: </b><a href="">{{$detalles->nombre}}</a></li>
                            <li><b>Área de conocimiento: </b>{{$detalles->area}}</li>
                            <li><b>Tiempo estimado de desarrollo: </b>{{$detalles->tiempo}}</li>

                            @if($detalles->estatus =='Publicado')
                            <li><b>Estatus del Proyecto: </b>  {{$detalles->estatus}}</li>
                            @elseif($detalles->estatus == 'En Desarrollo')
                            <li><b>Estatus del Proyecto: </b>  {{$detalles->estatus}}</li>
                            @elseif($detalles->estatus == 'Terminado')
                            <li><b>Estatus del Proyecto: </b> {{$detalles->estatus}}</li>
                            @elseif($detalles->estatus == 'Cancelado')
                            <li><b>Estatus del Proyecto: </b>  {{$detalles->estatus}}</li>
                            @endif
                        </ul>          
                        <p><b>Descripción General: </b>{{$detalles->descripcion}}</p>
                        <H4>Entregas:</H4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Fecha Entrega</th>
                                <th scope="col">Prórroga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$progresos->isEmpty())
                                @foreach($progresos as $progresos)
                                <tr>
                                    <td>{{$progresos->nombre_progreso}}</td>
                                    <td>{{$progresos->descripcion}}</td>
                                    <td>{{$progresos->fecha_entrega}}</td>
                                    <td>{{$progresos->fecha_prorroga}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <hr>
                        <center>
                        <h3>Presupuesto disponible ${{$detalles->presupuesto}} USD</h3>
                        
                        <hr>
                        <p>
                        <td>
                        <form id="doc" action="{{route('descargarArchivo')}}" method="post">
                        {{ csrf_field() }}
                            <input type="hidden" name="archivo" value="{{$detalles->anexo}}">
                        </form>
                        @if(Auth::user()->rol=='Freelancer')
                            @if($solicituduser->isEmpty())
                                @if($detalles->estatus == 'Publicado')
                                    <input type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Solicitar Participacion">
                                @endif
                            @else
                                @if($detalles->estatus == 'Publicado')
                                    <input type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-primary" value="Ver mi Solicitud">
                                @endif
                            @endif
                        @endif
                        <input type="button" onclick="bajarDoc()" class="btn btn-dark" value="Descargar Documento de Requerimientos">
                        </center>
                        </td>
                        </p>
                    </div>
        </div>
        <div class="col-md-5">
        <div class="well" style="width:100%;">
            @if(Auth::user()->rol=='Freelancer')
                <embed src="{{ asset('anexos/') }}/{{$detalles->anexo}}" width="100%" height="500" alt="pdf" />
            @endif
            @if(Auth::user()->rol=='Cliente')
                @if(!$solicitudes->isEmpty())
                    @foreach($solicitudes as $solicitudes)
                    
                        <div style="background-color:black; position: relative; display:flex;" class="panel-heading">
                        
                        <h4 class="text-white">Solicitud de {{$solicitudes->username}}   </h4>
                        <p>&nbsp;&nbsp;</p><button style="" onclick="verPerfil({{$solicitudes->id_user}})" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></button>
                        <p>&nbsp;&nbsp;</p><button style="" onclick="crearChat({{$solicitudes->id_user}})" class="btn btn-primary"><span class="glyphicon glyphicon-comment"></span></button>
                        @if($solicitudes->estatus != 'Rechazada' && $solicitudes->estatus != 'Aceptada')
                            <p>&nbsp;&nbsp;</p><button style="" onclick="crearContrato({{$solicitudes->id_user}})" class="btn btn-default"><span class="glyphicon glyphicon-list-alt"></span></button>
                        @endif
                        </div>
                        
                            <form id="form{{$solicitudes->id_user}}" action="" method="get">
                                {{ csrf_field() }}  
                                    <input type="hidden" name="id_user" value="{{$solicitudes->id_user}}">
                                    <input type="hidden" name="id_solicitud" value="{{$solicitudes->id_solicitud}}">
                            </form>
                    
                            <div style="background-color:white;" class="panel-body">
                                <li><b>Mensaje: </b>{{$solicitudes->mensaje}}</li>
                                <li><b>Fecha límite respuesta: </b>{{$solicitudes->limite}}</li>
                                <li><b>Estatus: </b>{{$solicitudes->estatus}}</li>
                            </div>
                            <br>
                    @endforeach
                @endif
            @endif
        </div>
        </div>
        </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Solicitar participación en <b> {{$detalles->titulo}} </b></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('enviarsolicitud') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}   
                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label">Mensaje:</label>
                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="mensaje" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label">Límite de Espera:</label>
                            <div class="col-md-6">
                                <input id="titulo" type="date" class="form-control" name="limite" value="" required autofocus>
                            </div>
                        </div>
                            <input id="titulo" type="hidden" class="form-control" name="id_proyecto" value="{{$detalles->id_proyecto}}" required autofocus>
                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label">Límite de Espera:</label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary" value="Enviar solicitud">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </div>
        </div>

        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Solicitud enviada a <b> {{$detalles->titulo}} </b></h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('eliminarsolicitud')}}" method="post">
                    {{csrf_field()}}
                     {{ method_field('delete') }}
                    @if(!$solicituduser->isEmpty())
                        @foreach($solicituduser as $sol)
                            <b>Mensaje:</b> {{$sol->mensaje}}<br>
                            <b>Limite:</b> {{$sol->limite}}
                            <input type="hidden" name="id_solicitud" value="{{$sol->id_solicitud}}">
                        @endforeach
                    @endif
                    <br>
                    <button type="submit" class="form-control btn btn-default">Eliminar Solicitud</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
                @endforeach
    @endif




 <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
    </script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/1.0/zxcvbn.min.js"></script>


<script>
$(function() {
	$(document).ready(function () {
		$("#StrengthProgressBar").zxcvbnProgressBar({ passwordInput: "#password" });
    });
});

function bajarDoc()
{
    document.getElementById("doc").submit();
}

function verPerfil(i)
{
    document.getElementById("form"+i).action = "{{route('verPerfil')}}";
    document.getElementById("form"+i).submit();
}

function crearChat(i)
{
    document.getElementById("form"+i).action = "{{route('crearChat')}}";
    document.getElementById("form"+i).method = "post";
    document.getElementById("form"+i).submit();
}

function crearContrato(i)
{
    document.getElementById("form"+i).action = "{{route('crearContrato')}}";
    document.getElementById("form"+i).method = "post";
    document.getElementById("form"+i).submit();
}


</script>
@endsection