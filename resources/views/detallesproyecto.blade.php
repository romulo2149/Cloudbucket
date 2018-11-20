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
                            <li><b>Estatus del Proyecto: </b><i style="font-size:24px" class="fa">&#xf1ea;</i>  {{$detalles->estatus}}</li>
                            @elseif($detalles->estatus == 'En Desarrollo')
                            <li><b>Estatus del Proyecto: </b><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>  {{$detalles->estatus}}</li>
                            @elseif($detalles->estatus == 'Terminado')
                            <li><b>Estatus del Proyecto: </b><i style="font-size:24px" class="fa">&#xf11e;</i>  {{$detalles->estatus}}</li>
                            @elseif($detalles->estatus == 'Cancelado')
                            <li><b>Estatus del Proyecto: </b><i style="font-size:24px" class="fa">&#xf05e;</i>  {{$detalles->estatus}}</li>
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
                        <input type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Solicitar Participacion">
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
                    
                        <div style="background-color:black;" class="panel-heading">
                        <td>
                        <h4 class="text-white">Solicitud de {{$solicitudes->username}}</h4>
                            <form id="form{{$solicitudes->id_user}}" action="{{route('perfilFreelancer')}}" method="post">
                                {{ csrf_field() }}  
                                    <input type="hidden" name="id_user" value="{{$solicitudes->id_user}}">
                            </form>
                            <button onclick="verPerfil({{$solicitudes->id_user}})" class="btn btn-success"><span class="glyphicon glyphicon-user"></span></button>
                            <button onclick="verPerfil({{$solicitudes->id_user}})" class="btn btn-success"><span class="glyphicon glyphicon-user"></span></button>
                        </td>
                        </div>
                            <div style="background-color:white;" class="panel-body">
                                <li><b>Mensaje: </b>{{$solicitudes->mensaje}}</li>
                                <li><b>Fecha límite respuesta: </b>{{$solicitudes->limite}}</li>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    document.getElementById("form"+i).submit();
}


</script>
@endsection