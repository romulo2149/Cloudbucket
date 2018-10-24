@extends('layouts.app')

@section('content')
<div class="container">
<div class="spacing50"></div>
<div class="table">
    <div class="col-md-12">

 
        
    @if(!$detalles->isEmpty())
            @foreach($detalles as $detalles) 

            <!-- Empieza detalles proyecto -->
            <div class="row">
                <div class="col-sm-7 col-md-7">
                    <div class="well">
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
                        <p>{{$detalles->descripcion}}</p>
                        <hr>
                        <center>
                        <h3>Presupuesto disponible ${{$detalles->presupuesto}} MXN</h3>
                        
                        <hr>
                        <p>
                        <form action="{{route('descargarArchivo')}}" method="post">
                        {{ csrf_field() }}
                            <input type="hidden" name="archivo" value="{{$detalles->anexo}}">
                            <button type="submit" class="btn btn-success">Descargar {{$detalles->anexo}}</button>
                        </form>
                        </center>
                        </p>
                    </div>
                </div>  
                @if(Auth::user()->role=='Client')
                <div class="col-sm-5 col-md-5">
                    <div class="well">
                    <p><h4>Progreso del Proyecto</h4>
                    @if($detalles->estatus == 'Publicado')
                    <form action="{{route('actualizarestatus')}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }} 
                    <input type="hidden" value="{{$detalles->id_proyecto}}" name="id_proyecto">
                    <input type="hidden" value="En Desarrollo" name="estatus">
                    <button type="submit" style="display:inline" class="btn btn-warning">Iniciar Proyecto</button>
                    </form>
                    @elseif($detalles->estatus == 'En Desarrollo')
                    <form action="{{route('actualizarestatus')}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }} 
                    <input type="hidden" value="{{$detalles->id_proyecto}}" name="id_proyecto">
                    <input type="hidden" value="Terminado" name="estatus">
                    <button type="submit" style="display:inline" class="btn btn-success">Finalizar Proyecto</button>
                    </form>
                    @endif
                    </p>

                    <table id="table" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Freelancer</th>
                            <th>Estatus</th>
                            <th>Rating</th>
                            <th>Liberar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$progreso->isEmpty())
                        @foreach ($progreso as $progreso)
                            <tr>
                                <td>{{$progreso->nombre}}</td>
                                <td>{{$progreso->estatus}}</td>
                                <td>
                                @if($progreso->estatus == 'trabajando')
                                <div class="input-group">           
                                <span class="input-group-btn">
                                <button onclick="quit({{$progreso->id}});" type="button" class="btn btn-default btn-number">
                                    <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    </span>
                                    <input id="{{'cambio'.$progreso->id}}" class="form-control input-number" style="width:45px;" min="0.00" max="5.00" required>
                                    <span class="input-group-btn">
                                <button onclick="add({{$progreso->id}});" type="button" class="btn btn-default btn-number">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </span>
                                </div> 
                                </td>
                                
                                <td>
                                
                                <form method="post" action="{{route('liberar')}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }} 
                                    <input id="{{'cambioII'.$progreso->id}}" type="hidden" min="0.00" max="5.00" name="rating" required>
                                    <input type="hidden" name="idproyecto" value="{{$progreso->id_proyecto}}">
                                    <input type="hidden" name="iduser" value="{{$progreso->id}}">
                                    <input type="hidden" name="idprogreso" value="{{$progreso->id_progreso}}">
                                    <input type="hidden" name="estatus" value="liberado">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-unlock-alt"></i></button>
                                </form>
                                @else
                                    {{$progreso->ratingP}}
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                        </table>
                    </div>
                </div>
                @endif

        <!-- Termina detalles proyecto -->
    
        <div class="spacing50"></div>
       <!-- Empiezan propuestas -->

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <!-- Empiezan propuestas cliente -->
                    @if(Auth::user()->role=='Client')
                        @foreach($propuesta as $pro)
                            @if($pro->proyecto==$detalles->id_proyecto)
                                <div class="panel panel-default">
                                <div class="panel-heading"><h4 class="text-white">Propuesta de {{$pro->nombreUser}}</h4></div>
                                <div class="panel-body">
                                <form action="{{route('updatepropuesta')}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }} 
                                <input type="hidden" name="propuesta" value="{{$pro->id_propuesta}}"></input>
                                <div class="form-group">
                                    <label for="titulo" class="col-md-4 control-label">Descripcion: </label>
                                    <p>{{$pro->descripcion}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="dudas" class="col-md-4 control-label">Dudas: </label>
                                    <p>{{$pro->dudas}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="cobro" class="col-md-4 control-label">Cobro: </label>
                                    <p>{{$pro->cobro}}</p>
                                </div>
                                @if($pro->estatus=='sin revisión')
                                <div class="form-group">
                                    <label for="cobro" class="col-md-4 control-label">Estatus</label>
                                    <select name="estatus" id="estatus">
                                        <option value="aceptada">Propuesta Ganadora</option>
                                        <option value="rechazada">Propuesta NO Ganadora</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <input type="hidden" name="proyectoId" value="{{$pro->proyecto}}">
                                        <input type="hidden" name="userId" value="{{$pro->user}}">
                                        <button type="submit" class="btn btn-default">Enviar resultados</button>
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="cobro" class="col-md-4 control-label">Estatus</label>
                                    <p>{{$pro->estatus}}</p>
                                </div>
                                @endif
                                </form>  
                                </div>
                                </div>
                            @endif
                        @endforeach
                        
                    <!-- terminan propuestas cliente -->



                    <!-- Empiezan propuestas Freelancer -->
                    @elseif(Auth::user()->role=='Freelancer')

                            @if(!$propuestauser->isEmpty())
                                @foreach($propuestauser as $propuestauser)
                                    @if($propuestauser->proyecto == $detalles->id_proyecto)
                                        <div class="panel panel-default">
                                        <div class="panel-heading"><h4 class="text-white">Tú propuesta</h4></div>
                                        <div class="panel-body">
                                        <div class="form-group">
                                            <label for="titulo" class="col-md-4 control-label">Descripcion: </label>
                                            <p>{{$propuestauser->descripcion}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="dudas" class="col-md-4 control-label">Dudas: </label>
                                            <p>{{$propuestauser->dudas}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="cobro" class="col-md-4 control-label">Cobro: </label>
                                            <p>{{$propuestauser->cobro}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="cobro" class="col-md-4 control-label">Estatus: </label>
                                            <p>{{$propuestauser->estatus}}</p>
                                        </div>
                                    @endif
                                @endforeach
                            @elseif($detalles->estatus=='Publicado')
                            <div class="col-md-10 col-md-offset-1">
                                    <div class="panel panel-default">
                                    <div class="panel-heading"><h4 class="text-white">Subir Propuesta</h4></div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" action="{{route('subirpropuesta')}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="proyecto" value="{{$detalles->id_proyecto}}"></input>
                                            <div class="form-group">
                                                <label for="titulo" class="col-md-4 control-label">Descripcion</label>
                                                <div class="col-md-6">
                                                    <textarea id="descripcion" name="descripcion" value="" class="form-control" rows="5" id="comment" required autofocus>
                                                    </textarea>                                
                                                </div>                                        
                                            </div>
                                            <div class="form-group">
                                                <label for="dudas" class="col-md-4 control-label">Dudas</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="dudas" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cobro" class="col-md-4 control-label">Cobro</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="number" min="0.00" name="cobro" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <center>
                                                    <button type="submit" class="btn btn-default form-control" style="width:30%" >Enviar Propuesta</button>
                                            </center>
                                            </div>
                                            </form>  
                                        </div>
                                    </div>
                                    </div>
                                
                            @endif

                    @endif
                    <!-- terminan propuestas Freelancer -->



                </div>
            </div>
        </div>



    @endforeach
    @endif
   
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


 <!-- Scripts -->

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


</script>
@endsection