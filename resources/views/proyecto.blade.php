@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.3.54/css/materialdesignicons.min.css">
<div class="spacing50"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-white">Subir Proyecto</h4></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('subirproyecto') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}                         

                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label">Titulo</label>
                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="titulo" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">                                                        
                            <label for="comment" class="col-md-4 control-label">Descripcion</label>
                            <div class="col-md-6">
                                <textarea id="descripcion" name="descripcion" value="" class="form-control" rows="5" id="comment" required autofocus>
                                </textarea>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="area" class="col-md-4 control-label">Area</label>
                            <div class="col-md-6">
                               <select id="area" name="area" class="form-control">
                                   @foreach($area as $area)
                                    <option value="{{$area->id_area}}">{{$area->titulo}}</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="anexo" class="col-md-4 control-label">Anexo</label>
                            <div class="col-md-6">
                                <input id="anexo" class="form-control-file" type="file" name="anexo" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="presupuesto" class="col-md-4 control-label">Presupuesto</label>
                            <div class="col-md-6">
                                <input id="presupuesto" type="number" class="form-control" name="presupuesto" min="0.00" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tiempo" class="col-md-4 control-label">Tiempo Estimado</label>
                            <div class="col-md-6">
                                <input id="tiempo" type="text" class="form-control" name="tiempo" value="" required autofocus>
                            </div>
                        </div>
                        <h4 style="text-align:center">Seleccione habilidades solicitadas para el Proyecto</h4>
                        <div class="form-group">
                        <div class="col-md-10 col-md-offset-1">
                            <ul class="list-group" id="checkbox-grid">
                                @foreach($etiquetas as $etiqueta)
                                <li class="list-group-item">
                                <div class="pretty p-icon p-round p-tada">
                                    <input type="checkbox" name="etiquetas[]" value="{{$etiqueta->id_habilidad}}" />
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
                        <center>                                   
                            <button type="submit" id="EnviarProyecto" class="btn btn-primary form-control"  style="width:80%" >Enviar Proyecto</button>                                    
                        </center>
                    </div> 
                                            
                    </form>
                </div>            

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
<script type="text/javascript">
$(function() {
	$(document).ready(function () {
		$("#StrengthProgressBar").zxcvbnProgressBar({ passwordInput: "#password" });
    });
    $('#EnviarProyecto').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("Selecciona una o mas habilidades.");
        return false;
      }

    });
});
</script>
