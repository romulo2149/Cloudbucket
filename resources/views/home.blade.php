@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <br>
            <div class="panel panel-default">
                <div class="panel-heading"><p class="text-white">Mis Proyectos<p class="text-white"></div>

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
                                        <th>Consultar Proyecto</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                    @foreach($proyecto as $proyecto)    
                                        <tr>
                                        <td>{{$proyecto->titulo}}</td>
                                        <td>{{$proyecto->area}}</td>
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
                    @endif

                    @if(Auth::user()->rol=='Freelancer')
                        Eres un Freelancer
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
