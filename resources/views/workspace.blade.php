@extends('layouts.app')

@section('content')

@if(!$proyecto->isEmpty())
@foreach($proyecto as $pro)
<div class="container">
    <div class="row">
        <div class="col-md-8">
        <br>
            <div class="panel panel-default">
                <div class="panel-heading"><p class="text-white">{{$pro->titulo}} - {{$pro->estatus}}</p></div>
                <div class="panel-body">
                <H4>Entregas:</H4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Fecha Entrega</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Prórroga</th>
                                @if(Auth::user()->rol == 'Cliente' || Auth::user()->rol == 'Empresa')
                                <th scope="col">Cambiar Estatus</th>
                                @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$progreso->isEmpty())
                                @foreach($progreso as $progresos)
                                <tr>
                                    <td>{{$progresos->nombre_progreso}}</td>
                                    <td>{{$progresos->descripcion}}</td>
                                    <td>{{$progresos->fecha_entrega}}</td>
                                    <td>{{$progresos->estatus}}</td>
                                    <td>{{$progresos->fecha_prorroga}}</td>
                                    @if(Auth::user()->rol == 'Cliente' || Auth::user()->rol == 'Empresa')
                                    <td>
                                        <form action="{{route('estatusProgreso')}}" method="post">
                                            {{ csrf_field() }}  
                                            <input type="hidden" name="id_progreso" value="{{$progresos->id_progreso}}">
                                            @if($progresos->estatus == 'Establecida')
                                                <input type="hidden" name="estatus" value="En Desarrollo">
                                                <input type="submit" class="form-control btn btn-warning" value="Iniciar">
                                            @elseif($progresos->estatus == 'En Desarrollo')
                                                <input type="hidden" name="estatus" value="Terminada">
                                                <input type="submit" class="form-control btn btn-success" value="Terminar">
                                            @else
                                            Progreso terminado
                                            @endif
                                        </form>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if(Auth::user()->rol == 'Cliente' || Auth::user()->rol == 'Empresa')
                            @if($pro->estatus == 'Terminado')
                            @if($liberar->isEmpty())
                                <input type="button" value="Formato de Liberación de Freelancer" data-toggle="modal" data-target="#myModal" class="form-control btn btn-primary">
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Liberar Freelancer </b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('liberar')}}" method="post">
                                            {{ csrf_field() }} 
                                            @if(!$freelancer->isEmpty())
                                                @foreach($freelancer as $f)
                                                    <input type="hidden" name="id_freelancer" value="{{$f->id}}">
                                                    <input type="hidden" name="data" value="{{$pro->id_proyecto}}">
                                                @endforeach
                                                <input type="text" class="form-control" name="comentario" id="" placeholder="Escribe un comentario"><br>
                                                <select id="sel" name="valoracion" class="form-control" placeholder="Selecciona una valoracion">
                                                    <option value="1">Una estrella</option>
                                                    <option value="2">Dos estrellas</option>
                                                    <option value="3">Tres estrellas</option>
                                                    <option value="4">Cuatro estrellas</option>
                                                    <option value="5">Cinco estrellas</option>
                                                </select><br>
                                            @endif
                                                <input type="submit" class="form-control btn btn-success" value="Liberar">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                El freelancer ya fué liberado
                            @endif
                            @endif
                        @endif
                </div>
            </div>
        </div>
        @if(Auth::user()->rol == 'Cliente')
            <div class="col-md-4">
            <br>
            @if(!$freelancer->isEmpty())
                @foreach($freelancer as $f)
                    <div class="panel panel-default">
                        <div class="panel-heading"><p class="text-white">Freelancer</p></div>
                        <div class="panel-body">
                            <center>
                            <div class="form-group ">
                                @if($f->image!=null)
                                    <img class="imagenUsuario" style=" width:128px; height:128px; border-radius: 50%;"
                                    src="{{ asset( 'uploads/'.$f->image)}}" alt="Imagen Usuario">                    
                                @else
                                    <img class="imagenUsuario" style=" width:128px; height:128px; border-radius: 50%; " 
                                    src="{{ asset( 'img/default_user.png' )}}" alt="Imagen Usuario">
                                @endif 
                                <form id="form{{$f->id}}" action="" method="get">
                                    {{ csrf_field() }}  
                                        <input type="hidden" name="id_user" value="{{$f->id}}">
                                </form>
                            </div>
                            </center>
                            <div style="padding-left:40px; position: relative; display:flex;">
                                <h4>{{$f->name}}</h4>
                                <p>&nbsp;&nbsp;</p><button style="" onclick="verPerfil({{$f->id}})" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></button>
                                <p>&nbsp;&nbsp;</p><button style="" onclick="crearChat({{$f->id}})" class="btn btn-default"><span class="glyphicon glyphicon-comment"></span></button>
                            </div>
                            <hr>
                            @if(!$solicitud->isEmpty())
                            @foreach($solicitud as $sol)
                                <form action="{{route('verContrato')}}" method="get">
                                        {{ csrf_field() }}  
                                        <input type="hidden" name="data" value="{{$sol->id_contrato}}">
                                        <input type="submit" class="form-control btn btn-default" value="Ver Contrato">
                                </form>
                            @endforeach
                            @endif
                        </div>
                    </div>

                @endforeach
            @endif
            </div>
        @endif

        @if(Auth::user()->rol == 'Freelancer')
            <div class="col-md-4">
            <br>
            @if(!$cliente->isEmpty())
                @foreach($cliente as $c)
                    <div class="panel panel-default">
                        <div class="panel-heading"><p class="text-white">Cliente</p></div>
                        <div class="panel-body">
                            <center>
                            <div class="form-group ">
                                @if($c->image!=null)
                                    <img class="imagenUsuario" style=" width:128px; height:128px; border-radius: 50%;"
                                    src="{{ asset( 'uploads/'.$c->image)}}" alt="Imagen Usuario">                    
                                @else
                                    <img class="imagenUsuario" style=" width:128px; height:128px; border-radius: 50%; " 
                                    src="{{ asset( 'img/default_user.png' )}}" alt="Imagen Usuario">
                                @endif 
                                <form id="form{{$c->id}}" action="" method="get">
                                    {{ csrf_field() }}  
                                        <input type="hidden" name="id_user" value="{{$c->id}}">
                                </form>
                            </div>
                            </center>
                            <div style="padding-left:40px; position: relative; display:flex;">
                                <h4>{{$c->name}}</h4>
                                <p>&nbsp;&nbsp;</p><button style="" onclick="verPerfil({{$c->id}})" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></button>
                                <p>&nbsp;&nbsp;</p><button style="" onclick="crearChat({{$c->id}})" class="btn btn-default"><span class="glyphicon glyphicon-comment"></span></button>
                            </div>
                            <hr>
                            @if(!$solicitud->isEmpty())
                            @foreach($solicitud as $sol)
                                <form action="{{route('verContrato')}}" method="get">
                                        {{ csrf_field() }}  
                                        <input type="hidden" name="data" value="{{$sol->id_contrato}}">
                                        <input type="submit" class="form-control btn btn-default" value="Ver Contrato">
                                </form>
                            @endforeach
                            @endif
                        </div>
                    </div>

                @endforeach
            @endif
            </div>
        @endif

        @if(Auth::user()->rol == 'Empresa')
            <div class="col-md-4">
            <br>
            @if(!$freelancer->isEmpty())
                @foreach($freelancer as $f)
                    <div class="panel panel-default">
                        <div class="panel-heading"><p class="text-white">Freelancer</p></div>
                        <div class="panel-body">
                            <center>
                            <div class="form-group ">
                                @if($f->image!=null)
                                    <img class="imagenUsuario" style=" width:128px; height:128px; border-radius: 50%;"
                                    src="{{ asset( 'uploads/'.$f->image)}}" alt="Imagen Usuario">                    
                                @else
                                    <img class="imagenUsuario" style=" width:128px; height:128px; border-radius: 50%; " 
                                    src="{{ asset( 'img/default_user.png' )}}" alt="Imagen Usuario">
                                @endif 
                                <form id="form{{$f->id}}" action="" method="get">
                                    {{ csrf_field() }}  
                                        <input type="hidden" name="id_user" value="{{$f->id}}">
                                </form>
                            </div>
                            </center>
                            <div style="padding-left:40px; position: relative; display:flex;">
                                <h4>{{$f->name}}</h4>
                                <p>&nbsp;&nbsp;</p><button style="" onclick="verPerfil({{$f->id}})" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></button>
                                <p>&nbsp;&nbsp;</p><button style="" onclick="crearChat({{$f->id}})" class="btn btn-default"><span class="glyphicon glyphicon-comment"></span></button>
                            </div>
                            <hr>
                            @if(!$solicitud->isEmpty())
                            @foreach($solicitud as $sol)
                                <form action="{{route('verContrato')}}" method="get">
                                        {{ csrf_field() }}  
                                        <input type="hidden" name="data" value="{{$sol->id_contrato}}">
                                        <input type="submit" class="form-control btn btn-default" value="Ver Contrato">
                                </form>
                            @endforeach
                            @endif
                        </div>
                    </div>

                @endforeach
            @endif
            </div>
        @endif
    </div> <!-- row -->
</div> <!-- container -->
@endforeach
@endif

<script>
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

</script>
@endsection