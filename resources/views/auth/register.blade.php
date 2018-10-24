@extends('layouts.app')

@section('content')
<div class="spacing50"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-white">Registrar</h4></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <img class="registro center-block" src="{{asset('img/logo.png')}}" alt="">
                        <br>
                        <p class="text-center">CloudBucket</p>
                        <br>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Rol</label>
                                <div class="col-md-6">                            
                                <center>
                                    <div class="buying-selling-group" id="buying-selling-group" data-toggle="radio">
                                        <label class="btn btn-default buying-selling">
                                            <input type="radio" name="role" value="Cliente" id="option1" onclick="rolUsuario('cliente')">
                                            <span class="radio-dot"></span>
                                            <span class="buying-selling-word">Cliente</span>
                                        </label>
                                    
                                        <label class="btn btn-default buying-selling">
                                            <input type="radio" name="role" value="Freelancer" id="option2"onclick="rolUsuario('freelancer')">
                                            <span class="radio-dot"></span>
                                            <span class="buying-selling-word">Freelancer</span>
                                        </label>

                                        <label class="btn btn-default buying-selling">
                                            <input type="radio" name="role" value="Empresa" id="option3"onclick="rolUsuario('empresa')">
                                            <span class="radio-dot"></span>
                                            <span class="buying-selling-word">Empresa</span>
                                        </label>
                                    </div>
                                </center>
                                </div>
                        </div>                                

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label"> </label>
                            <div class="col-md-6">
                                <div class="progress">
                                    <div id="StrengthProgressBar" class="progress-bar"></div>
                                </div>
                            </div>
                        </div>

                        <div id="cliente" style="display:none">
                                <div class="form-group" >
                                    <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="nombreC" type="text" class="form-control" name="nombre" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos" class="col-md-4 control-label">Apellidos</label>
                                    <div class="col-md-6">
                                        <input id="apellidosC" type="text" class="form-control" name="apellidos" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="domicilio" class="col-md-4 control-label">Domicilio</label>
                                    <div class="col-md-6">
                                        <input id="domicilioC" type="text" class="form-control" name="domicilio" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telefono" class="col-md-4 control-label">Telefono</label>
                                    <div class="col-md-6">
                                        <input id="telefonoC" type="text" class="form-control" name="telefono" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sitio" class="col-md-4 control-label">Sitio Web*</label>
                                    <div class="col-md-6">
                                        <input id="sitioC" type="text" class="form-control" name="sitio" >
                                    </div>
                                </div>
                        </div>

                        <div id="freelancer" style="display:none">
                                <div class="form-group" >
                                    <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="nombreF" type="text" class="form-control" name="nombre" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos" class="col-md-4 control-label">Apellidos</label>
                                    <div class="col-md-6">
                                        <input id="apellidosF" type="text" class="form-control" name="apellidos" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sitio" class="col-md-4 control-label">Fecha de Nacimiento</label>
                                    <div class="col-md-6">
                                        <input id="fechaF" type="date" class="form-control" name="fecha" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="domicilio" class="col-md-4 control-label">Domicilio</label>
                                    <div class="col-md-6">
                                        <input id="domicilioF" type="text" class="form-control" name="domicilio" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telefono" class="col-md-4 control-label">Telefono</label>
                                    <div class="col-md-6">
                                        <input id="telefonoF" type="text" class="form-control" name="telefono" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sitio" class="col-md-4 control-label">Sitio Web*</label>
                                    <div class="col-md-6">
                                        <input id="sitioF" type="text" class="form-control" name="sitio" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sitio" class="col-md-4 control-label">Salario Hora*</label>
                                    <div class="col-md-6">
                                        <input id="salarioF" type="text" class="form-control" name="salario" >
                                    </div>
                                </div>
                        </div>

                        <div id="empresa" style="display:none">
                                <div class="form-group" >
                                    <label for="nombre" class="col-md-4 control-label">Nombre Representante</label>
                                    <div class="col-md-6">
                                        <input id="nombreE" type="text" class="form-control" name="nombre" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos" class="col-md-4 control-label">Apellidos Representante</label>
                                    <div class="col-md-6">
                                        <input id="apellidosE" type="text" class="form-control" name="apellidos" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="apellidos" class="col-md-4 control-label">Nombre de Empresa</label>
                                    <div class="col-md-6">
                                        <input id="apellidosE" type="text" class="form-control" name="empresa" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="domicilio" class="col-md-4 control-label">Domicilio Fiscal</label>
                                    <div class="col-md-6">
                                        <input id="domicilioE" type="text" class="form-control" name="domicilio" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telefono" class="col-md-4 control-label">Telefono</label>
                                    <div class="col-md-6">
                                        <input id="telefonoE" type="text" class="form-control" name="telefono" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sitio" class="col-md-4 control-label">Sitio Web*</label>
                                    <div class="col-md-6">
                                        <input id="sitioE" type="text" class="form-control" name="sitio" >
                                    </div>
                                </div>
                        </div>


                        <div class="form-group">
                            <center>
                                <p>Al confirmar su registro usted acepta los <a>Terminos y Condiciones</a> y <a>Politicas de Privacidad</a>.</p>
                            </center>
                        </div>
                        
                        <div class="form-group">
                            <div class="panel-heading">
                            <center>
                                <button type="submit" class="btn tur text-white" style="width:80%">
                                    Registrar
                                </button>
                                </center>
                            </div>
                        </div>

                        <center>
                            <p>¿Usted ya esta registrado? <a href="{{ route('login') }}">Inicie Sesion</a></p>
                        </center>
                        
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
});



function rolUsuario(rol)
{
    switch(String(rol))
    {
        case "cliente" :
            document.getElementById("cliente").style.display = "block";
                document.getElementById("nombreC").name = "nombre";
                document.getElementById("apellidosC").name = "apellidos";
                document.getElementById("telefonoC").name = "telefono";
                document.getElementById("domicilioC").name = "domicilio";
                document.getElementById("sitioC").name = "sitio";
            document.getElementById("freelancer").style.display = "none";
                document.getElementById("nombreF").name = "nombreF";
                document.getElementById("apellidosF").name = "apellidosF";
                document.getElementById("telefonoF").name = "telefonoF";
                document.getElementById("domicilioF").name = "domicilioF";
                document.getElementById("sitioF").name = "sitioF";
            document.getElementById("empresa").style.display = "none";
                document.getElementById("nombreE").name = "nombreE";
                document.getElementById("apellidosE").name = "apellidosE";
                document.getElementById("telefonoE").name = "telefonoE";
                document.getElementById("domicilioE").name = "domicilioE";
                document.getElementById("sitioE").name = "sitioE";
            break;
        case "freelancer" :
            document.getElementById("cliente").style.display = "none";
                document.getElementById("nombreC").name = "nombreC";
                document.getElementById("apellidosC").name = "apellidosC";
                document.getElementById("telefonoC").name = "telefonoC";
                document.getElementById("domicilioC").name = "domicilioC";
                document.getElementById("sitioC").name = "sitioC";
            document.getElementById("freelancer").style.display = "block";
                document.getElementById("nombreF").name = "nombre";
                document.getElementById("apellidosF").name = "apellidos";
                document.getElementById("telefonoF").name = "telefono";
                document.getElementById("domicilioF").name = "domicilio";
                document.getElementById("sitioF").name = "sitio";
            document.getElementById("empresa").style.display = "none";
                document.getElementById("nombreE").name = "nombreE";
                document.getElementById("apellidosE").name = "apellidosE";
                document.getElementById("telefonoE").name = "telefonoE";
                document.getElementById("domicilioE").name = "domicilioE";
                document.getElementById("sitioE").name = "sitioE";
            break;
        case "empresa" :
            document.getElementById("cliente").style.display = "none";
                document.getElementById("nombreC").name = "nombreC";
                document.getElementById("apellidosC").name = "apellidosC";
                document.getElementById("telefonoC").name = "telefonoC";
                document.getElementById("domicilioC").name = "domicilioC";
                document.getElementById("sitioC").name = "sitioC";
            document.getElementById("freelancer").style.display = "none";
                document.getElementById("nombreF").name = "nombreF";
                document.getElementById("apellidosF").name = "apellidosF";
                document.getElementById("telefonoF").name = "telefonoF";
                document.getElementById("domicilioF").name = "domicilioF";
                document.getElementById("sitioF").name = "sitioF";
            document.getElementById("empresa").style.display = "block";
                document.getElementById("nombreE").name = "nombre";
                document.getElementById("apellidosE").name = "apellidos";
                document.getElementById("telefonoE").name = "telefono";
                document.getElementById("domicilioE").name = "domicilio";
                document.getElementById("sitioE").name = "sitio";
            break;
    }
}
</script>
@endsection