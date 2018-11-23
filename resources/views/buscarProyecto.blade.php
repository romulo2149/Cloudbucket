@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.3.54/css/materialdesignicons.min.css">
<div class="spacing50"></div>
<div class="container"> 
    <div class="row">
        <div class="col-md-14">
            <div class="panel panel-default">
                <div class="panel-heading"><p class="text-white">Buscar Proyectos</p></div>
                <div class="panel-body" id="imprimir">
                            <header>
                                <div class="container">
                                    <center>
                                        @if($proyecto)
                                        <div class="table-responsive">
                                            <div class="col-md-11">
                                              <table class="table table-hover">
                                                <thead>
                                                  <tr>
                                                    <th>Proyecto</th>
                                                    <th>Ofertas y/o Propuestas</th>
                                                    <th>Presupuesto</th>
                                                    <th>Tiempo</th>
                                                    <th>Consultar Proyecto</th>
                                                  </tr>
                                                </thead>
                                                <tbody>  
                                                @foreach($proyecto as $proyecto)    
                                                  <tr>
                                                    <td>{{$proyecto->titulo}}</td>
                                                    <td>{{$proyecto->area}}</td>
                                                    <td>{{$proyecto->presupuesto}}</td>
                                                    <td>{{$proyecto->tiempo}}</td>
                                                    <td>
                                                        <form method="get" action="{{ route('detallesproyectofreelancer') }}">
                                                        {{ csrf_field() }}
                                                            <input type="hidden" value="{{$proyecto->id_proyecto}}" name="data" >
                                                            <button type="submit" class="btn btn-primary form-control" aria-hidden="true">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                  </tr>
                                                @endforeach  
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                        @else
                                        @endif
                                    </center>
                                </div>
                            </header>
                        </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('mostrarProyecto')}}">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="name" class="col-md-1 control-label">Buscar</label>
                            <div class="col-md-11">                            
                                <input id="searchName" type="text" class="form-control" name="searchName" placeholder="Indique un titulo o nombre de Proyecto a Buscar" value="" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">    
                        <div class="col-md-10 col-md-offset-1">                                                                               
                            <ul class="list-group" id="checkbox-grid">
                                @foreach($etiquetas as $etiqueta)
                                    <li class="list-group-item">
                                    <div class="pretty p-icon p-round p-tada">
                                        <input id="searchHabilities" type="checkbox" name="habilidades[]" value="{{$etiqueta->id_etiqueta}}" />
                                            <div class="state p-primary-o">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>{{$etiqueta->titulo}}</label>
                                            </div>
                                    </div>
                                    </li>
                                @endforeach                                                                    
                            </ul>    
                        </div>                        
                        </div>
                        
                        <div class="form-group">
                            <div class="panel-heading">
                            <center>
                                <button type="submit" class="btn btn-primary" style="width:80%" id="buscar">
                                    Buscar Proyectos
                                </button>
                                </center>
                            </div>
                        </div>
                    </form>                        
                </div>            
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
var proyecto = document.getElementById("searchName").;
    
$(document).ready(function() {
        
    $("buscar").on("click", function(proyecto){
        $("imprimir").load("buscarproyecto.blade.php imprimir");
    });
        
});
    
</script>
@endsection