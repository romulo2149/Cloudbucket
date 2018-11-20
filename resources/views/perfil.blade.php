@extends('layouts.app')
<style>
.dropdown-menu li:hover {
    background-color: #ddd;
}
</style>
@section('content')
<link href="{{ asset('css/star-rating.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-formhelpers.css') }}" rel="stylesheet">
<link href="{{ asset('css/languages.css') }}" rel="stylesheet">
<link href="{{ asset('css/languages.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.3.54/css/materialdesignicons.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:white">Imagen de Perfil</div>
                    <div class="panel-body">
                       
                            <!-- Image -->
                            <form id="editarImagen" class="form-horizontal" action="{{ route('guardarImagen') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <center><h1>{{$informacionusuario->name}}</h1></center>

                                <center>
                                <div class="form-group ">
                                    @if($informacionusuario->image!=null)
                                        <img class="imagenUsuario" style=" width:256px; height:256px; border-radius: 50%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"
                                        src="{{ asset( 'uploads/'.$informacionusuario->image)}}" alt="Imagen Usuario">                    
                                    @else
                                        <img class="imagenUsuario" style=" width:256px; height:256px; border-radius: 50%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" 
                                        src="{{ asset( 'img/default_user.png' )}}" alt="Imagen Usuario">
                                    @endif 
                                </div>
                                </center>
                                 
                            <!--Calificacion de estrellas-->
                                 <div class="form-group ">
                                    <center>                    
                                        <input id="input-21b" value="{{$informacionusuario->valoracion}}" type="hidden" class="rating" data-min=0 data-max=5 data-step=0.2 data-size="md" required title="" readonly>
                                        <div class="clearfix"></div>
                                    </center>
                                </div>
                                
                            <!--Calificacion de estrellas-->                             

                                <div class="form-group ">
                                <label class="col-sm-2 control-label">Imagen de Perfil</label>
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    Seleccionar Archivo&hellip; 
                                                    <input type="file" style="display: none;" name="imagen" accept="image/*" required>
                                                </span>
                                            </label>
                                            <input type="text" class="form-control" value="{{$informacionusuario->image}}" readonly>                        
                                        </div> 
                                    </div>
                                </div>  

                                <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
                                <center>
                                    @if ($errors->has('imagen'))
                                       
                                            <span class="help-block">
                                                <strong>{{ $errors->first('imagen') }}</strong>
                                            </span>
                                       
                                    @endif
                                </center>
                                </div>

                                <div class="form-group">
                                <center>
                                   
                                        <button id="guardarImagen" type="submit" class="btn btn-primary form-control"  style="width:60%">Cambiar Imagen</button>
                                   
                                </center>
                                </div>       
                            <!-- Image -->   

                            </form>                           
                    </div>                    
                </div>      
                      
            </div>
        </div>
    </div>    
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:white">Informacion de la cuenta</div>
                    <div class="panel-body">

                        <form id="editarInformacion" class="form-horizontal" action="{{ route('cambiarNombre') }}" method="POST">                                                           
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="nombre" value="{{$informacionusuario->nombre}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Apellidos</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="apellidos" value="{{$informacionusuario->apellidos}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Correo Electronico</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="{{$informacionusuario->email}}" readonly>
                                </div>
                            </div>   
                                          
                            
                            <div class="form-group">
                                <center>                                   
                                    <button id="guardarImagen" type="submit" class="btn btn-primary form-control"  style="width:60%">Cambiar Nombre</button>                                   
                                </center>
                            </div> 
                        </form>                 

                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:white">Informacion de Contacto</div>
                    <div class="panel-body">

                    <form id="editarSueldoHora" class="form-horizontal" action="{{ url('/perfil/savePhone') }}" method="POST">                                                           
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telefono</label>
                                <div class="col-sm-10">
                                    <div class="input-group"> 
                                        <span class="input-group-addon">
                                        <i class="fas fa-phone"  aria-hidden="true"></i>
                                        </span>
                                        <input type="text" value="{{$informacionusuario->telefono}}" maxlength="10" minlength="7" class="form-control" id="phone" name="phone" required/>
                                    </div>                                 
                                </div> 
                            </div>                           
                    
                            <div class="form-group">
                                <center>                                   
                                    <button id="guardarSueldo" type="submit" class="btn btn-primary form-control"  style="width:80%">Actualizar Telefono</button>                                   
                                </center>
                            </div> 
                    </form>   

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->rol=='Freelancer')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:white">Informacion Academica</div>
                    <div class="panel-body">
                        
                        <h3 style="text-align:center">Mi Informacion Academica</h3>   
                        <table class="table table-hover" id"MisIdiomas">
                            <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Institucion</th>                                 
                                <th>Periodo</th>                                     
                                <th>Editar</th>   
                                <th>Eliminar</th>   
                            </tr>
                            </thead>
                            <tbody>                            
                            @if($informacionAcademica)
                                    @foreach($informacionAcademica as $informacionAcademica)                                    
                                        <tr>                                                
                                            <td>{{$informacionAcademica->nivel}}</td>
                                            <td>{{$informacionAcademica->institucion}}</td>                                                                                                                           
                                            <td>{{$informacionAcademica->fecha_inicio}} - {{$informacionAcademica->fecha_fin}}</td>                                        
                                            <td>
                                                <button id="EditarInformacionAcademica" class="btn btn-default" 
                                                data-idInformacionAcademica="{{$informacionAcademica->id_laboral}}"
                                                data-nivel="{{$informacionAcademica->nivel}}"
                                                data-institucion="{{$informacionAcademica->institucion}}"
                                                data-fechainicio="{{$informacionAcademica->fecha_inicio}}"
                                                data-fechafin="{{$informacionAcademica->fecha_fin}}"
                                                ><i class="fas fa-pen-square fa-2x"  aria-hidden="true"></i></button>                                                
                                            </td>                                        
                                            <td>
                                                <button id="EliminarInformacionAcademica" class="btn btn-default" name="{{$informacionAcademica->id_laboral}}"><i class="fa fa-trash-alt fa-2x icondelete"  aria-hidden="true"></i></button>
                                            </td>          
                                        </tr>
                                    @endforeach
                                @else                                    
                            @endif                   
                            </tbody>
                        </table>
                        
                        <div class="form-group">
                            <center>                                   
                                <button id="nuevaInformacionAcademica" class="btn btn-primary form-control"  style="width:80%" data-toggle="modal" data-target="#NuevaInformacionAcademicaModal">Agregar Informacion Academica</button>
                            </center>
                        </div>    

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:white">Informacion Laboral</div>
                    <div class="panel-body">
                    
                    <form id="editarSueldoHora" class="form-horizontal" action="{{ url('/perfil/saveSalary') }}" method="POST">                                                           
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sueldo/Hora (USD)</label>
                                <div class="col-sm-10">
                                    <div class="input-group"> 
                                        <span class="input-group-addon">
                                        <i class="fas fa-dollar-sign"  aria-hidden="true"></i>
                                        </span>
                                        <input type="number" value="{{$informacionusuario->salario_hora}}" min="0.00" step="1.00" data-number-to-fixed="2.00" data-number-stepfactor="100" class="form-control currency" id="sueldo" name="sueldo" />
                                    </div>                                 
                                </div> 
                            </div>                           
                    
                            <div class="form-group">
                                <center>                                   
                                    <button id="guardarSueldo" type="submit" class="btn btn-primary form-control"  style="width:80%">Actualizar Sueldo</button>                                   
                                </center>
                            </div> 
                    </form>                      
                    <hr class="my-4">                    
                                                                            
                    <h3 style="text-align:center">Mi Informacion Laboral</h3>   
                        <table class="table table-hover" id"MisIdiomas">
                            <thead>
                            <tr>
                                <th>Cargo</th>
                                <th>Institucion</th>                                 
                                <th>Periodo</th>                                     
                                <th>Editar</th>   
                                <th>Eliminar</th>   
                            </tr>
                            </thead>
                            <tbody>                            
                            @if($informacionLaboral)
                                    @foreach($informacionLaboral as $informacionLaboral)                                    
                                        <tr>                                                
                                            <td>{{$informacionLaboral->cargo}}</td>
                                            <td>{{$informacionLaboral->institucion}}</td>                                                                                                                           
                                            <td>{{$informacionLaboral->fecha_inicio}} - {{$informacionLaboral->fecha_fin}}</td>                                        
                                            <td>
                                                <button id="EditarInformacionLaboral" class="btn btn-default" 
                                                data-idInformacionLaboral="{{$informacionLaboral->id_laboral}}"
                                                data-cargo="{{$informacionLaboral->cargo}}"
                                                data-institucion="{{$informacionLaboral->institucion}}"
                                                data-fechainicio="{{$informacionLaboral->fecha_inicio}}"
                                                data-fechafin="{{$informacionLaboral->fecha_fin}}"
                                                ><i class="fas fa-pen-square fa-2x"  aria-hidden="true"></i></button>                                                
                                            </td>                                        
                                            <td>
                                                <button id="EliminarInformacionLaboral" class="btn btn-default" name="{{$informacionLaboral->id_laboral}}"><i class="fa fa-trash-alt fa-2x icondelete"  aria-hidden="true"></i></button>
                                            </td>          
                                        </tr>
                                    @endforeach
                                @else                                    
                            @endif                   
                            </tbody>
                        </table>

                        <div class="form-group">
                        <center>                                   
                            <button id="NuevaInformacionLaboral" class="btn btn-primary form-control"  style="width:80%" data-toggle="modal" data-target="#NuevaInformacionLaboralModal">Agregar Informacion Laboral</button>
                        </center>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Eliminar Informacion Academica-->
<div class="modal fade" id="EliminarInformacionAcademicaModal" tabindex="-1" role="dialog" aria-labelledby="Eliminar Idioma">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar ésta Informacion Academica?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="EliminarInformacionAcademicaForm">
            {{ csrf_field() }}            
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>
<!--Modal Editar Informacion Academica-->
<div class="modal fade" id="EditarInformacionAcademicaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Editar Informacion Academica</h4>
            </div>            
            <!-- Modal Body -->
            <div class="modal-body">                
                <form class="form-horizontal" role="form" action="/perfil/informacionAcademica/editInformacionAcademica" method="POST">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Nivel</label>
                    <div class="col-sm-10">
                        <div class="slidecontainer">
                        @if( !empty($informacionAcademica->nivel) ) 
                            <input type="text" id="nivelM" name="nivelM" class="form-control" value="{{$informacionAcademica->nivel}}">
                        @endif
                        </div>
                    </div>   
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Institución</label>
                    <div class="col-sm-10">
                        <div class="slidecontainer">
                        @if( !empty($informacionAcademica->institucion) ) 
                            <input type="text" id="institucionMIA" name="institucionMIA" class="form-control" value="{{$informacionAcademica->institucion}}">
                        @endif
                        </div>
                    </div>                    
                  </div>

                   <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Año de Inicio</label>
                    <div class="col-sm-10">
                        <div class="slidecontainer">
                        @if( !empty($informacionAcademica->fecha_inicio) ) 
                            <input type="text" id="fechainicioMIA" name="fechainicioMIA" class="form-control" value="{{$informacionAcademica->fecha_inicio}}">
                        @endif
                        </div>
                    </div>                    
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Año de Termino</label>
                    <div class="col-sm-10">
                    @if( !empty($informacionAcademica->fecha_fin) ) 
                        <input type="text" id="fechafinMIA" name="fechafinMIA" class="form-control" value="{{$informacionAcademica->fecha_fin}}">
                    @endif
                    @if( !empty($informacionAcademica->id_laboral) ) 
                        <input type="hidden" id="idInformacionAcademicaM" name="idInformacionAcademicaM" class="form-control" value="{{$informacionAcademica->id_laboral}}">
                    @endif
                    </div>                    
                  </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

                </form>          
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="NuevaInformacionAcademicaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nueva Informacion Academica</h4>
            </div>            
            <!-- Modal Body -->
            <div class="modal-body">                
                <form class="form-horizontal" role="form" action="/perfil/informacionAcademica" method="POST">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Nivel</label>
                    <div class="col-sm-10">
                        <div class="slidecontainer">
                            <input type="text" id="nivel" name="nivel" class="form-control" required value="">
                        </div>
                    </div>   
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Institución</label>
                    <div class="col-sm-10">
                        <div class="slidecontainer">
                            <input type="text" id="institucionIA" name="institucionIA" class="form-control" value="" required>
                        </div>
                    </div>                    
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Año de Inicio</label>
                    <div class="col-sm-10">
                        <input type="number" id="Ainicio" name="Ainicio" class="form-control" min="1950" max="2050" required>                        
                    </div>                    
                  </div>

                   <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Año de Termino</label>
                    <div class="col-sm-10">
                        <input type="number" id="Atermino" name="Atermino" class="form-control" min="1950" max="2050" required>                        
                    </div>                    
                  </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

                </form>          
            </div>
            
        </div>
    </div>
</div>

@endif
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//geodata.solutions/includes/countrystate.js"></script>
<script src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>
<script>
    $("button#EliminarInformacionAcademica").click(function(){
        var idInformacionAcademica = $(this).attr('name');
        $('#EliminarInformacionAcademicaModal').modal('show');
        $('form#EliminarInformacionAcademicaForm').attr('action','/perfil/informacionAcademica/'+idInformacionAcademica+'/delete');
   });

   $('button#EditarInformacionAcademica').click(function(){
        var id_laboral = $(this).attr('data-idInformacionAcademica');
        var nivel = $(this).attr('data-nivel');
        var institucion = $(this).attr('data-institucion');
        var fecha_inicio = $(this).attr('data-fechainicio');
        var fecha_fin = $(this).attr('data-fechafin');        
        $('#EditarInformacionAcademicaModal').modal('show');        
        $('#EditarInformacionAcademicaModal').on('shown.bs.modal', function (e) {
            $('#nivelM').attr('value',nivel);
            $('#institucionMIA').attr('value',institucion);
            $('#fechainicioMIA').attr('value',fecha_inicio);
            $('#fechafinMIA').attr('value',fecha_fin);
            $('#idInformacionAcademicaM').attr('value',id_laboral);
        })
    });
    $("button#EliminarInformacionLaboral").click(function(){
        var idInformacionLaboral = $(this).attr('name');
        $('#EliminarInformacionLaboralModal').modal('show');
        $('form#EliminarInformacionLaboralForm').attr('action','/profile/informacionLaboral/'+idInformacionLaboral+'/delete');
   });

    $('button#EditarInformacionLaboral').click(function(){
        var idInformacionLaboral = $(this).attr('data-idInformacionLaboral');
        var cargo = $(this).attr('data-cargo');
        var institucion = $(this).attr('data-institucion');
        var fechainicio = $(this).attr('data-fechainicio');
        var fechafin = $(this).attr('data-fechafin');        
        $('#EditarInformacionLaboralModal').modal('show');        
        $('#EditarInformacionLaboralModal').on('shown.bs.modal', function (e) {
            $('#cargoM').attr('value',cargo);
            $('#institucionMIL').attr('value',institucion);
            $('#fechainicioMIL').attr('value',fechainicio);
            $('#fechafinMIL').attr('value',fechafin);
            $('#idInformacionLaboralM').attr('value',idInformacionLaboral);
        })
    });

    
    

</script>
@endsection