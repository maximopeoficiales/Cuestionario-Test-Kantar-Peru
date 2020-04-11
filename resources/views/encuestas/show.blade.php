@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/style.css">
@endsection
@section('content')


<div class='wrapper animated bounce' style="width: 95%; margin: 0 auto;">
    <div class="question">
        <h2 class="text-center">{{$encuesta->titulo}}</h2> 
        <div class="text-center">
        <img src="{{$encuesta->imagen}}" alt="encuenta.img" style="width: 80%; height: 400px; border-radius: 5%;">
        </div>
        <div class="text-center my-4">
            <button type="button" class='btn-check animated infinite pulse delay-2s' onclick="next()"><i class="fas fa-play-circle mr-2"></i>Iniciar</button>
        </div>
    </div>
    @foreach ($preguntas as $pre)
        @if ($pre->id_tipo==1)
        <div class='question d-none'>
            <div class='question-headline text-center'>
              {{$pre->titulo}}
            </div>
            <p class="my-2 h5">{{$pre->enunciado}}</p>
            <div class='question-answers'>
              <textarea name="" id="" class="form-control"></textarea>
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
            </div>
        </div>
        @endif
        @if ($pre->id_tipo==2)
        <div class='question d-none'>
            <div class='question-headline text-center'>
              {{$pre->titulo}}
            </div>
            <div class='question-answers'>
                <div class="row">
                    <div class="col-md-10">
                        <p class="h5">{{$pre->enunciado}}</p>
                    </div>
                    <div class="col-md-2">
                    <input type="number" class="form-control">
                    </div>
                </div>
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
            </div>
        </div>
        @endif
        @if ($pre->id_tipo==3)
        <div class='question d-none'>
            <div class='question-headline text-center'>
              {{$pre->titulo}}
            </div>
            <div class='question-answers' style="overflow-x:auto;">
                <table class="table table-bordered text-center" id="listado" width="100%;" style="font-size: 14px; height: 100px; max-height: 100px !important;">
                <thead>
                  <tr id="titulotable" style="background-color: #01224b !important; color: #fff !important;">
                    <th class="text-center" width="5%"><p>Nro.</p></th>
                    <th class="text-center" style="min-width: 150px"><p>Pregunta</p></th>
                    @foreach ($imagenes as $item)
                        @if ($item->imagen!='')
                            <th class="text-center" style="min-width: 100px">
                                <p data-toggle="tooltip" data-placement="top" title="Muy bueno">
                                <img
                                    class="text-center"
                                    src="{{$item->imagen}}"
                                    alt="imagenes.jpg"
                                    style="width: 40%; height: 25%;"
                                />
                                </p>
                            </th>    
                        @endif
                        
                    @endforeach
                  </tr>
                  <tr>
                    <td width="5%" class="text-center">1</td>
                    <td style="min-width: 150px" class="text-center">
                      {{$pre->enunciado}}
                    </td>
                    @foreach ($imagenes as $ima)
                        @if ($ima->imagen!='')
                            <td class="text-center" style="min-width: 100px">
                                <input class="radiocuento" type="radio" name="radio[6]" id="inlineRadio1" value="4"/>
                            </td>
                        @endif   
                    @endforeach
                  </tr>
                </thead>
              </table>
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
            </div>
        </div>
        @endif
        @if ($pre->id_tipo==4)
            <div class='question d-none'>
                <div class='question-headline text-center'>
                {{$pre->titulo}}
                </div>
                <div class='question-answers' style="overflow-x:auto;">
                    <table class="table table-bordered text-center" id="listado" width="100%;" style="font-size: 14px; height: 100px; max-height: 100px !important;">
                    <thead>
                    <tr id="titulotable" style="background-color: #01224b !important; color: #fff !important;">
                        <th class="text-center" style="min-width: 150px"><p>Pregunta</p></th>
                        @foreach ($textos as $text)
                            @if ($text->texto!='')
                                <th class="text-center">
                                    <p>{{$text->texto}}</p>
                                </th>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td style="min-width: 150px" class="text-center">
                        {{$pre->enunciado}}
                        </td>
                        @foreach ($textos as $t)
                            @if ($t->texto!='')
                            <td class="text-center">
                                <input class="radiocuento" type="radio" name="radio[6]" id="inlineRadio1" value="4"/>
                            </td>
                            @endif
                        @endforeach
                    </tr>
                    </thead>
                </table>
                </div>
                <div class="text-center my-4">
                    <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                    <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
                </div>
            </div>
        @endif
    @endforeach
    <div class='question d-none'>
        <div class='question-headline text-center'>
          ¡Felicitaciones ya ha terminado nuestra encuesta¡
        </div>
        <div class='question-answers'>
            <div class="text-center">
                <img src="https://image.freepik.com/vector-gratis/felicitaciones-tipografia-letras-manuscritas-tarjeta-felicitacion-banner_7081-766.jpg" 
                alt="encuenta.img" style="width: 80%; height: 400px; border-radius: 5%;">
            </div>
        </div>
        <div class="text-center my-4">
            <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
            <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s'><i class="fas fa-save mr-2"></i><small>Guardar</small></button>
        </div>
    </div>
    @push('scripts')
        <script>
            	var navs = document.getElementsByClassName('question');   
                var counter=0;
                function next() {
                    if (counter < (navs.length-1)) {
                        navs[counter].classList.add('d-none');
                        counter+=1;
                        navs[counter].classList.remove('d-none');
                    }
                }
                function previus() {
                    if (counter > 0) {
                        navs[counter].classList.add('d-none');
                        counter-=1;
                        navs[counter].classList.remove('d-none');
                    }
                }
        </script>
    @endpush
</div>
@endsection