@extends('layouts.app')

@section('content') 
<style>
.efecto:hover .imagen {-webkit-transform:scale(1.3);transform:scale(1.3);transition-duration: 500ms;}
.efecto {overflow:hidden;}
@media (max-width: 768px) {
    .mifuente {
        font-size: 30px;
    }
}
</style>
<div class="container">
<a href="{{route('encuestas')}}" class="btn btn-primary float-right animated bounce "><i class="fas fa-arrow-left mr-2"></i>Regresar</a>
    <br>
    <h1 class="text-center display-3 my-4 animated bounce mifuente">{{$texto->texto}}</h1>
    <div class="card-columns animated bounce">
        @foreach ($encuestas as $e)
        <div class="card" >
            <a href="#" data-toggle="modal" data-target="#exampleModal_{{$e->id_encuesta}}">
                <div class="efecto">
                    <img class="card-img-top imagen" src="{{$e->imagen}}" alt="Card image cap" style="width: 100%; height: 300px;">

                </div>
            </a>
            <div class="card-body animated rubberBand">
                @foreach ($e->informacion as $i)
                <h5 class="card-title text-center">{{$i->titulo}}</h5>
                <p class="card-text text-justify">{{$e->texto}}</p>
                        {{-- modal para ver detalle de la encuesta --}}
                
                
                @endforeach
              
            </div>
        </div>
        
        @endforeach
    </div> 
    @foreach ($encuestas as $e)
        @foreach ($e->informacion as $i)
        <div class="modal fade" id="exampleModal_{{$e->id_encuesta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 5%;">
                    <div class="modal-header">
                    <h5 class="modal-title h2" id="exampleModalLabel" style="margin: 0 auto;">{{$i->titulo}}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{$e->imagen}}" alt="encuesta img" class="my-4" style="width: 100%; height: 300px; border-radius: 10%">
                            <p>Valido Hasta: <b>{{$i->fecha_vencimiento}}</b></p>
                            <p>Total de Registros: <b>{{$i->cuenta}}</b></p>
                            <div class=" d-flex justify-content-center">
                                <a href="{{route('encuestas.show',[$id_encuesta_grupo_im,$e->id_encuesta])}}" class="btn btn-success mr-2"><i class="fa fa-sign-in mr-2" aria-hidden="true"></i>Ingresar</a>
                                <button type="button" class="btn btn-danger ml-2" data-dismiss="modal"><i class="fa fa-times mr-2" aria-hidden="true"></i>Cancelar</button>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>  
        @endforeach
    @endforeach 
</div>
@endsection
