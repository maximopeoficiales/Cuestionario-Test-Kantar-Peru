@extends('layouts.app')

@section('content') 
<style>
.efecto:hover .imagen {-webkit-transform:scale(1.3);transform:scale(1.3);transition-duration: 500ms;}
.efecto {overflow:hidden;}
</style>
<div class="container">
    <h1 class="text-center display-3 my-4 animated bounce">Encuestas</h1>
    @foreach ($encuestas as $e)
    <div class="card-columns animated bounce">
        <div class="card" >
        <a href="{{route('encuestas.index',$e->id_encuesta_grupo)}}">
                <div class="efecto">
                    <img class="card-img-top imagen" src="{{$e->imagen}}" alt="Card image cap" style="width: 100%; height: 300px;">

                </div>
            </a>
            <div class="card-body animated rubberBand">
                
                <h5 class="card-title text-center">{{$e->texto}}</h5>
                {{-- <p class="card-text text-justify">{{$e->texto}}</p> --}}
                        {{-- modal para ver detalle de la encuesta --}}
            </div>
        </div>
    </div> 
   
    @endforeach 
</div>
@endsection
