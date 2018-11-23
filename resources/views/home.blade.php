@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <br>
            <div class="panel panel-default">
                <div class="panel-heading"><p class="text-white">Mis Proyectos</p></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->rol=='Cliente' || Auth::user()->rol=='Empresa')
                        @if($proyecto)
                            <div class="table-responsive">
                                <div class="col-md-11">
                                    <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Proyecto</th>
                                        <th>Ofertas y/o Propuestas</th>
                                        <th>Estatus</th>
                                        <th>Consultar Proyecto</th>
                                        <th>Ver Worksapce</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                    @foreach($proyecto as $proyecto)    
                                        <tr>
                                        <td>{{$proyecto->titulo}}</td>
                                        <td>{{$proyecto->area}}</td>
                                        <td>{{$proyecto->estatus}}</td>
                                        <td>
                                            <form method="get" action="{{ route('detallesproyectofreelancer') }}">
                                            {{ csrf_field() }}
                                                <input type="hidden" value="{{$proyecto->id_proyecto}}" name="data" >
                                                <button type="submit" class="btn btn-primary form-control" aria-hidden="true">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="get" action="{{ route('workspace') }}">
                                            {{ csrf_field() }}
                                                <input type="hidden" value="{{$proyecto->id_proyecto}}" name="data" >
                                                <button type="submit" class="btn btn-success form-control" aria-hidden="true">
                                                    <i class="glyphicon glyphicon-wrench"></i>
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
                    @endif

                    @if(Auth::user()->rol=='Freelancer')
                        @if($solicitudes)
                            <div class="table-responsive">
                                <div class="col-md-11">
                                    <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Mensaje</th>
                                        <th>Limite</th>
                                        <th>Estatus</th>
                                        <th>Consultar Proyecto</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                    @foreach($solicitudes as $solicitud)    
                                        <tr>
                                        <td>{{$solicitud->mensaje}}</td>
                                        <td>{{$solicitud->limite}}</td>
                                        <td>{{$solicitud->estatus}}</td>
                                        <td>
                                            <form method="get" action="{{ route('detallesproyectofreelancer') }}">
                                            {{ csrf_field() }}
                                                <input type="hidden" value="{{$solicitud->id_proyecto}}" name="data" >
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
                        @if($contratos)
                            @foreach($contratos as $contrato)
                                <div class="table-responsive">
                                <div class="col-md-11">
                                    <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Solicitud</th>
                                        <th>Consultar Contrato</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                    @foreach($contratos as $contrato)    
                                        <tr>
                                        <td>{{$contrato->id_solicitud}}</td>
                                        <td>
                                            <form method="get" action="{{ route('firmar') }}">
                                            {{ csrf_field() }}
                                                <input type="hidden" value="{{$contrato->id}}" name="data" >
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
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
