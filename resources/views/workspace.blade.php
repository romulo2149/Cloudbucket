@extends('layouts.app')

@section('content')

@if(!$proyecto->isEmpty())
@foreach($proyecto as $pro)
<div class="container">
    <div class="row">
        <div class="col-md-8">
        <br>
            <div class="panel panel-default">
                <div class="panel-heading"><p class="text-white">{{$pro->titulo}}</p></div>
                <div class="panel-body">
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