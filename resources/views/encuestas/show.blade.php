@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/style.css">
@endsection
@section('content')
<style>
    @media only screen and (max-width: 700px) {
              video {
                  width: 100%;
              }
          }
    .textfile {
    font-size: 15px;
    }
    @media only screen and (max-width: 768px) {
        .textfile {
            font-size: 10px;
        }
    }
    .cambiodealtura {
            height: 400px;
        }
    @media only screen and (max-width: 768px) {
        .cambiodealtura {
            height: 200px;
        }
    }
  </style>

    <div class='wrapper animated bounce' style="width: 95%; margin: 0 auto;">
    <input type="hidden" id="fecha_hora" value="{{$fecha_hora}}">
        <div class="question">
            <h2 class="text-center">{{$encuesta->titulo}}</h2> 
            <div class="text-center cambiodealtura">
            <img src="{{$encuesta->imagen}}" alt="encuenta.img" style="width: 80%; border-radius: 5%;">
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check animated infinite pulse delay-2s' onclick="next()"><i class="fas fa-play-circle mr-2"></i>Iniciar</button>
            </div>
        </div>
        <!-- <div class="question d-none">
            <div class='question-headline text-center'>Escanee el codigo de barras del producto
                <button type="button" title="Ayuda" class="float-right h6 my-1 text-secondary" data-toggle="modal" data-target="#helpmodal" style="text-decoration: none;">Como escaneo un producto<i class="fas fa-question-circle ml-2"></i></button>
               
            </div>
            <div class='question-answers'>
                <div id="interactive" class="viewport"></div>
          <div id="result_strip">
            <ul class="thumbnails"></ul>
            <p id="informacion" class="text-secondary textfile"></p>
            <p id="informacion2" class="text-secondary textfile"></p>
            <button type='button' id="aqui" class='text-info d-none' style='text-decoration: none;'>Aqui</button>
            <input type="text" class="form-control d-none" placeholder="Example: ABC-abc-1234" id="cean">
            <ul class="collector"></ul>
          </div>
            <div class="controls">
                    <div class="botonstop">
                        <button class="stop btn-lg btn-primary"><i class="fas fa-stop-circle mr-2"></i>Stop</button>
                    </div>
                <fieldset class="reader-config-group">
                    <label style="display: none">
                        <span>Torch</span>
                        <input type="checkbox" name="settings_torch" />
                    </label>
                    <label style="display: none">
                        <span>Barcode-Type</span>
                        <select name="decoder_readers">
                            <option value="code_128" >Code 128</option>
                            <option value="code_39">Code 39</option>
                            <option value="code_39_vin">Code 39 VIN</option>
                            <option selected="selected" value="ean">EAN</option>
                            <option value="ean_extended">EAN-extended</option>
                            <option value="ean_8">EAN-8</option>
                            <option value="upc">UPC</option>
                            <option value="upc_e">UPC-E</option>
                            <option value="codabar">Codabar</option>
                            <option value="i2of5">Interleaved 2 of 5</option>
                            <option value="2of5">Standard 2 of 5</option>
                            <option value="code_93">Code 93</option>
                        </select>
                    </label>
                    <label style="display: none">
                        <span>Resolution (width)</span>
                        <select name="input-stream_constraints">
                            <option value="320x240">320px</option>
                            <option selected="selected" value="640x480">640px</option>
                            <option value="800x600">800px</option>
                            <option value="1280x720">1280px</option>
                            <option value="1600x960">1600px</option>
                            <option value="1920x1080">1920px</option>
                        </select>
                    </label>
                    <label style="display: none">
                        <span>Patch-Size</span>
                        <select name="locator_patch-size">
                            <option value="x-small">x-small</option>
                            <option value="small">small</option>
                            <option selected="selected" value="medium">medium</option>
                            <option value="large">large</option>
                            <option value="x-large">x-large</option>
                        </select>
                    </label>
                    <label style="display: none">
                        <span>Half-Sample</span>
                        <input type="checkbox" checked="checked" name="locator_half-sample" />
                    </label>
                    <label style="display: none">
                        <span>Workers</span>
                        <select name="numOfWorkers">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option selected="selected" value="4">4</option>
                            <option value="8">8</option>
                        </select>
                    </label>
                    <label>
                        <span>Camera:</span>
                        <select name="input-stream_constraints" id="deviceSelection">
                        </select>
                    </label>
                    <label style="display: none">
                        <span>Zoom</span>
                        <select name="settings_zoom"></select>
                    </label>
                   
                </fieldset>
            </div>
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><i class="fas fa-save mr-2"></i><small>Guardar</small></button>
            </div>
        </div> -->
        {{-- foto del producto --}}
        <div class="question d-none">
            <div class="question-headline text-center">
                Foto del producto
            </div>
            <input type="hidden" id="urlfoto">
            <div class="question-answers">
                    <form action="" method="POST" enctype="multipart/form-data" id="form_fotos">
                        @csrf
                        <div class="text-center">
                            <label for="foto">
                            <input type="hidden" id="id_encuesta2" value="{{$id_empleado}}">
                            <input type="file" name="foto" id="input_foto" class="textfile">
                            </label>
                            <a class="btn btn-primary text-white textfile" onclick="subirfoto()"><i class="fas fa-upload mr-2"></i>Subir foto</a>
                        </div>
                    </form>
                  <br>
                    {{-- captura de fotos --}}
                  <div class="text-center">
                       <div class="d-flex justify-content-center">
                        <select name="listaDeDispositivos" id="listaDeDispositivos" class="form-control"></select>
                        <a id="boton" class="btn btn-primary ml-3 text-white"><i class="fas fa-camera-retro"></i></a>
                       </div>  
                      <p id="estado"></p>
                    <p><b>{{$encuesta->texto_foto}}</b></p>
                        <video muted="muted" id="video"></video>
                        <canvas id="canvas" style="display: none;"></canvas>
                  </div>
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><i class="fas fa-save mr-2"></i><small>Guardar</small></button>
            </div>
        </div>
        {{-- Ubicacion --}}
        <input type="hidden" id="latitud" value="">
        <input type="hidden" id="longitud" value="">
        {{-- preguntas --}}
        @foreach ($preguntas as $pre)
        {{-- textarea --}}
            @if ($pre->id_tipo==1)
            <div class='question d-none'>
                <div class='question-headline text-center'>
                  {{$pre->titulo}}
                </div>
                <p class="my-2 h5">{{$pre->enunciado}}</p>
                <div class='question-answers'>
                  <textarea name="textarea" id="" class="form-control"></textarea>
                  <p class="my-2 h6 text-muted text-center">{{$pre->texto_ayuda}}</p>
                </div>
                <div class="text-center my-4">
                    <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                    <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
                </div>
            </div>
            @endif
            {{-- enteros --}}
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
                        <input type="number" name="enteros" class="form-control">
                        </div>
                    </div>
                    <p class="my-2 h6 text-muted text-center">{{$pre->texto_ayuda}}</p>
                </div>
                <div class="text-center my-4">
                    <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                    <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
                </div>
            </div>
            @endif
            {{-- emoticones con radio button --}}
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
                        @foreach ($pre->imagenes as $item)
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
                       
                        @foreach ($pre->imagenes  as $ima)
                            @if ($ima->imagen!='')
                                <td class="text-center" style="min-width: 100px">
                                <input class="radiocuento" type="radio" name="rb{{$radiocount}}"  value="{{$count}}"/>
                                </td>
                                @php $count++; @endphp   
                                @endif
                                
                                @endforeach
                                @php $radiocount++; @endphp
                                @php $count=1; @endphp   
                      </tr>
                    </thead>
                    </table>
                    <p class="my-2 h6 text-muted text-center">{{$pre->texto_ayuda}}</p>
                </div>
                <div class="text-center my-4">
                    <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                    <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
                </div>
            </div>
            @endif
            {{-- texto con radio button --}}
            @if ($pre->id_tipo==4)
                <div class='question d-none'>
                    <div class='question-headline text-center'>
                    {{$pre->titulo}}
                    </div>
                    <div class='question-answers' style="overflow-x:auto;">
                            <p class="text-center">
                            <b>{{$pre->enunciado}}</b>
                            </p>
                            @foreach ($pre->textos as $t)
                                @if ($t->texto!='')
                                <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="rt{{$radiocount2}}" value="{{$count2}}">{{$t->texto}}</label>
                                </div>
                                @php $count2++; @endphp   
                                @endif                                
                            @endforeach
                                @php $radiocount2++; @endphp   
                                @php $count2=1; @endphp   
                        <p class="my-2 h6 text-muted text-center">{{$pre->texto_ayuda}}</p>
                    </div>
                    <div class="text-center my-4">
                        <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                        <button type="button" class='btn-check ml-2 animated infinite pulse delay-2s' onclick="next()"><small>Next</small><i class="fas fa-arrow-circle-right ml-2"></i></button>
                    </div>
                </div>
            @endif
            @endforeach
  
        {{-- felicitaciones --}}
        <div class='question d-none'>
            <div class='question-headline text-center'>
              ¡Felicitaciones ya ha terminado nuestra encuesta¡
            </div>
            <div class='question-answers cambiodealtura'>
                <div class="text-center">
                    <img src="https://image.freepik.com/vector-gratis/felicitaciones-tipografia-letras-manuscritas-tarjeta-felicitacion-banner_7081-766.jpg" 
                    alt="encuenta.img" style="width: 80%;border-radius: 5%;">
                </div>
            </div>
            <div class="text-center my-4">
                <button type="button" class='btn-check bg-danger mr-2' onclick="previus()"><i class="fas fa-arrow-circle-right fa-rotate-180 mr-2"></i><small>Back</small></button>
                <button type="button" id="guardar_datos"  class='btn-check ml-2 animated infinite pulse delay-2s'><i class="fas fa-save mr-2"></i><small>Guardar</small></button>
            </div>
        </div>
        
    </div>

 {{-- modal help nota1: no agregara animaciones al modal--}} 
 <div class="modal fade" id="helpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 5%;">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">¿Como escanear un codigo de barras?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/Xyl8Ofd5VUo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
{{-- --------------- --}}
<!-- Button trigger modal -->
<button type="button" id="abrimodal2" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal2">
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 5%;">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Informacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="info_final" class="text-center"></p>
          <img src="" id="img_subida" style="width: 100%" class="cambiodealtura">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
        <script>

            function ObtenerRespuestas() {
                var inputs = $('[name="enteros"]').map(function(){return this.value;}).get();
                var textareas = $('[name="textarea"]').map(function(){return this.value;}).get();
                var rb_e =[];
                var rb_t=[];
                var porNombre=document.getElementsByName("rt1")[0].checked;

                for (let index = 1; index < {{$radiocount}}; index++) {
                    rb_e.push($('input:radio[name=rb'+index+']:checked').map(function(){return parseInt(this.value);}).get());
                }
                for (let index = 1; index < {{$radiocount2}}; index++) {
                    rb_t.push($('input:radio[name=rt'+index+']:checked').map(function(){return parseInt(this.value);}).get());
                }
                
                var respuestas = new Object();
                respuestas.textos=textareas;
                respuestas.enteros=inputs;
                respuestas.rb_emoticones=rb_e;
                respuestas.rb_textos=rb_t;
                return respuestas;
                
            }
        </script>
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
            {{-- script para el scaneo --}}
        <script>
             $(document).ready(function () {
                    //Si el navegador soporta geolocalizacion
                    if (!!navigator.geolocation) {
                    //Pedimos los datos de geolocalizacion al navegador
                    navigator.geolocation.getCurrentPosition(
                        //Si el navegador entrega los datos de geolocalizacion los imprimimos
                        function(position) {
                        console.log("Ubicacion Obtenida")
                        $("#latitud").val(position.coords.latitude);
                        $("#longitud").val(position.coords.longitude);
                        console.log("coordenadas: " + position.coords.latitude + " " + position.coords.longitude);
                        },
                        function() {
                        window.alert("Ubicacion no permitida");
                        }
                    );
                    }
                
                // $(function() {
                // var resultCollector = Quagga.ResultCollector.create({
                //     capture: true,
                //     capacity: 20,
                //     blacklist: [{
                //         code: "WIWV8ETQZ1", format: "code_93"
                //     }, {
                //         code: "EH3C-%GU23RK3", format: "code_93"
                //     }, {
                //         code: "O308SIHQOXN5SA/PJ", format: "code_93"
                //     }, {
                //         code: "DG7Q$TV8JQ/EN", format: "code_93"
                //     }, {
                //         code: "VOFD1DB5A.1F6QU", format: "code_93"
                //     }, {
                //         code: "4SO64P4X8 U4YUU1T-", format: "code_93"
                //     }],
                //     filter: function(codeResult) {
                //         // only store results which match this constraint
                //         // e.g.: codeResult
                //         return true;
                //     }
                // });
                // var App = {
                //     init: function() {
                //         var self = this;

                //         Quagga.init(this.state, function(err) {
                //             if (err) {
                //                 return self.handleError(err);
                //             }
                //             //Quagga.registerResultCollector(resultCollector);
                //             App.attachListeners();
                //             App.checkCapabilities();
                //             Quagga.start();
                //         });
                //     },
                //     handleError: function(err) {
                //         console.log(err);
                //     },
                //     checkCapabilities: function() {
                //         var track = Quagga.CameraAccess.getActiveTrack();
                //         var capabilities = {};
                //         if (typeof track.getCapabilities === 'function') {
                //             capabilities = track.getCapabilities();
                //         }
                //         this.applySettingsVisibility('zoom', capabilities.zoom);
                //         this.applySettingsVisibility('torch', capabilities.torch);
                //     },
                //     updateOptionsForMediaRange: function(node, range) {
                //         console.log('updateOptionsForMediaRange', node, range);
                //         var NUM_STEPS = 6;
                //         var stepSize = (range.max - range.min) / NUM_STEPS;
                //         var option;
                //         var value;
                //         while (node.firstChild) {
                //             node.removeChild(node.firstChild);
                //         }
                //         for (var i = 0; i <= NUM_STEPS; i++) {
                //             value = range.min + (stepSize * i);
                //             option = document.createElement('option');
                //             option.value = value;
                //             option.innerHTML = value;
                //             node.appendChild(option);
                //         }
                //     },
                //     applySettingsVisibility: function(setting, capability) {
                //         // depending on type of capability
                //         if (typeof capability === 'boolean') {
                //             var node = document.querySelector('input[name="settings_' + setting + '"]');
                //             if (node) {
                //                 node.parentNode.style.display = capability ? 'block' : 'none';
                //             }
                //             return;
                //         }
                //         if (window.MediaSettingsRange && capability instanceof window.MediaSettingsRange) {
                //             var node = document.querySelector('select[name="settings_' + setting + '"]');
                //             if (node) {
                //                 this.updateOptionsForMediaRange(node, capability);
                //                 node.parentNode.style.display = 'block';
                //             }
                //             return;
                //         }
                //     },
                //     initCameraSelection: function(){
                //         var streamLabel = Quagga.CameraAccess.getActiveStreamLabel();

                //         return Quagga.CameraAccess.enumerateVideoDevices()
                //         .then(function(devices) {
                //             function pruneText(text) {
                //                 return text.length > 30 ? text.substr(0, 30) : text;
                //             }
                //             var $deviceSelection = document.getElementById("deviceSelection");
                //             while ($deviceSelection.firstChild) {
                //                 $deviceSelection.removeChild($deviceSelection.firstChild);
                //             }
                //             devices.forEach(function(device) {
                //                 var $option = document.createElement("option");
                //                 $option.value = device.deviceId || device.id;
                //                 $option.appendChild(document.createTextNode(pruneText(device.label || device.deviceId || device.id)));
                //                 $option.selected = streamLabel === device.label;
                //                 $deviceSelection.appendChild($option);
                //             });
                //         });
                //     },
                //     attachListeners: function() {
                //         var self = this;

                //         self.initCameraSelection();
                //         $(".controls").on("click", "button.stop", function(e) {
                //             e.preventDefault();
                //             Quagga.stop();
                //             self._printCollectedResults();
                //         });

                //         $(".controls .reader-config-group").on("change", "input, select", function(e) {
                //             e.preventDefault();
                //             var $target = $(e.target),
                //                 value = $target.attr("type") === "checkbox" ? $target.prop("checked") : $target.val(),
                //                 name = $target.attr("name"),
                //                 state = self._convertNameToState(name);

                //             console.log("Value of "+ state + " changed to " + value);
                //             self.setState(state, value);
                //         });
                //     },
                //     _printCollectedResults: function() {
                //         var results = resultCollector.getResults(),
                //             $ul = $("#result_strip ul.collector");

                //         results.forEach(function(result) {
                //             var $li = $('<li><div class="thumbnail"><div class="imgWrapper"><img /></div><div class="caption"><h4 class="code"></h4></div></div></li>');

                //             $li.find("img").attr("src", result.frame);
                //             $li.find("h4.code").html(result.codeResult.code + " (" + result.codeResult.format + ")");
                //             $ul.prepend($li);
                           
                //         });
                //     },
                //     _accessByPath: function(obj, path, val) {
                //         var parts = path.split('.'),
                //             depth = parts.length,
                //             setter = (typeof val !== "undefined") ? true : false;

                //         return parts.reduce(function(o, key, i) {
                //             if (setter && (i + 1) === depth) {
                //                 if (typeof o[key] === "object" && typeof val === "object") {
                //                     Object.assign(o[key], val);
                //                 } else {
                //                     o[key] = val;
                //                 }
                //             }
                //             return key in o ? o[key] : {};
                //         }, obj);
                //     },
                //     _convertNameToState: function(name) {
                //         return name.replace("_", ".").split("-").reduce(function(result, value) {
                //             return result + value.charAt(0).toUpperCase() + value.substring(1);
                //         });
                //     },
                //     detachListeners: function() {
                //         $(".controls").off("click", "button.stop");
                //         $(".controls .reader-config-group").off("change", "input, select");
                //     },
                //     applySetting: function(setting, value) {
                //         var track = Quagga.CameraAccess.getActiveTrack();
                //         if (track && typeof track.getCapabilities === 'function') {
                //             switch (setting) {
                //             case 'zoom':
                //                 return track.applyConstraints({advanced: [{zoom: parseFloat(value)}]});
                //             case 'torch':
                //                 return track.applyConstraints({advanced: [{torch: !!value}]});
                //             }
                //         }
                //     },
                //     setState: function(path, value) {
                //         var self = this;

                //         if (typeof self._accessByPath(self.inputMapper, path) === "function") {
                //             value = self._accessByPath(self.inputMapper, path)(value);
                //         }

                //         if (path.startsWith('settings.')) {
                //             var setting = path.substring(9);
                //             return self.applySetting(setting, value);
                //         }
                //         self._accessByPath(self.state, path, value);

                //         console.log(JSON.stringify(self.state));
                //         App.detachListeners();
                //         Quagga.stop();
                //         App.init();
                //     },
                //     inputMapper: {
                //         inputStream: {
                //             constraints: function(value){
                //                 if (/^(\d+)x(\d+)$/.test(value)) {
                //                     var values = value.split('x');
                //                     return {
                //                         width: {min: parseInt(values[0])},
                //                         height: {min: parseInt(values[1])}
                //                     };
                //                 }
                //                 return {
                //                     deviceId: value
                //                 };
                //             }
                //         },
                //         numOfWorkers: function(value) {
                //             return parseInt(value);
                //         },
                //         decoder: {
                //             readers: function(value) {
                //                 if (value === 'ean_extended') {
                //                     return [{
                //                         format: "ean_reader",
                //                         config: {
                //                             supplements: [
                //                                 'ean_5_reader', 'ean_2_reader'
                //                             ]
                //                         }
                //                     }];
                //                 }
                //                 return [{
                //                     format: value + "_reader",
                //                     config: {}
                //                 }];
                //             }
                //         }
                //     },
                //     state: {
                //         inputStream: {
                //             type : "LiveStream",
                //             constraints: {
                //                 width: {min: 640},
                //                 height: {min: 480},
                //                 facingMode: "environment",
                //                 aspectRatio: {min: 1, max: 2}
                //             }
                //         },
                //         locator: {
                //             patchSize: "medium",
                //             halfSample: true
                //         },
                //         numOfWorkers: 2,
                //         frequency: 10,
                //         decoder: {
                //             readers : [{
                //                 format: "code_128_reader",
                //                 config: {}
                //             }]
                //         },
                //         locate: true
                //     },
                //     lastResult : null
                // };

                // App.init();

                // Quagga.onProcessed(function(result) {
                //     var drawingCtx = Quagga.canvas.ctx.overlay,
                //         drawingCanvas = Quagga.canvas.dom.overlay;

                //     if (result) {
                //         if (result.boxes) {
                //             drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                //             result.boxes.filter(function (box) {
                //                 return box !== result.box;
                //             }).forEach(function (box) {
                //                 Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                //             });
                //         }

                //         if (result.box) {
                //             Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                //         }

                //         if (result.codeResult && result.codeResult.code) {
                //             Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
                //         }
                //     }
                // });
                // var counts=0;
                // Quagga.onDetected(function(result) {
                //     var code = result.codeResult.code;

                //     if (App.lastResult !== code) {
                //         App.lastResult = code;
                //         var $node = null, canvas = Quagga.canvas.dom.image;

                //         $node = $('<li><div class="thumbnail"><div class="imgWrapper"><img /></div><div class="caption"><h4 class="code h6"></h4></div></div></li>');
                //         $node.find("img").attr("src", canvas.toDataURL());
                //         $node.find("h4.code").html(code);
                //         $("#result_strip ul.thumbnails").prepend($node);
                //         $("#cean").val(code);
                //         console.log(code);
                //         counts++;
                //         let codigo=code.length;
                //         if ( codigo > 12) {
                //             $("#informacion").text("El código ingresa cumple con los estandares de un codigo EAN de 13 digitos. Si es correcto pulse Guardar");
                //         }
                //         if (counts>2) {
                //             $("#informacion2").text("Si tiene problemas enfoncando el codigo puede ingresarlo manualmente haciendo click");
                //             $("#aqui").removeClass("d-none");
                //         }
                        
                            
                        
                //         /* aqui puedes obtener el codigo */

                //     }
                // });

            // });
            
             });
             $("#aqui").click(function (e) { 
                $("#cean").removeClass("d-none");
            });
        </script>
        {{-- para la toma de fotos --}}
        <script>
                    const tieneSoporteUserMedia = () =>
                !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
            const _getUserMedia = (...arguments) =>
                (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

            // Declaramos elementos del DOM
            const $video = document.querySelector("#video"),
                $canvas = document.querySelector("#canvas"),
                $estado = document.querySelector("#estado"),
                $boton = document.querySelector("#boton"),
                $listaDeDispositivos = document.querySelector("#listaDeDispositivos");

            const limpiarSelect = () => {
                for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
                    $listaDeDispositivos.remove(x);
            };
            const obtenerDispositivos = () => navigator
                .mediaDevices
                .enumerateDevices();

            // La función que es llamada después de que ya se dieron los permisos
            // Lo que hace es llenar el select con los dispositivos obtenidos
            const llenarSelectConDispositivosDisponibles = () => {

                limpiarSelect();
                obtenerDispositivos()
                    .then(dispositivos => {
                        const dispositivosDeVideo = [];
                        dispositivos.forEach(dispositivo => {
                            const tipo = dispositivo.kind;
                            if (tipo === "videoinput") {
                                dispositivosDeVideo.push(dispositivo);
                            }
                        });

                        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
                        if (dispositivosDeVideo.length > 0) {
                            // Llenar el select
                            dispositivosDeVideo.forEach(dispositivo => {
                                const option = document.createElement('option');
                                option.value = dispositivo.deviceId;
                                option.text = dispositivo.label;
                                $listaDeDispositivos.appendChild(option);
                            });
                        }
                    });
            }

            (function() {
                // Comenzamos viendo si tiene soporte, si no, nos detenemos
                if (!tieneSoporteUserMedia()) {
                    alert("Lo siento. Tu navegador no soporta esta característica");
                    $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
                    return;
                }
                //Aquí guardaremos el stream globalmente
                let stream;


                // Comenzamos pidiendo los dispositivos
                obtenerDispositivos()
                    .then(dispositivos => {
                        // Vamos a filtrarlos y guardar aquí los de vídeo
                        const dispositivosDeVideo = [];

                        // Recorrer y filtrar
                        dispositivos.forEach(function(dispositivo) {
                            const tipo = dispositivo.kind;
                            if (tipo === "videoinput") {
                                dispositivosDeVideo.push(dispositivo);
                            }
                        });

                        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
                        // y le pasamos el id de dispositivo
                        if (dispositivosDeVideo.length > 0) {
                            // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                            mostrarStream(dispositivosDeVideo[0].deviceId);
                        }
                    });



                const mostrarStream = idDeDispositivo => {
                    _getUserMedia({
                            video: {
                                // Justo aquí indicamos cuál dispositivo usar
                                deviceId: idDeDispositivo,
                            }
                        },
                        (streamObtenido) => {
                            // Aquí ya tenemos permisos, ahora sí llenamos el select,
                            // pues si no, no nos daría el nombre de los dispositivos
                            llenarSelectConDispositivosDisponibles();

                            // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                            $listaDeDispositivos.onchange = () => {
                                // Detener el stream
                                if (stream) {
                                    stream.getTracks().forEach(function(track) {
                                        track.stop();
                                    });
                                }
                                // Mostrar el nuevo stream con el dispositivo seleccionado
                                mostrarStream($listaDeDispositivos.value);
                            }

                            // Simple asignación
                            stream = streamObtenido;

                            // Mandamos el stream de la cámara al elemento de vídeo
                            $video.srcObject = stream;
                            $video.play();

                            //Escuchar el click del botón para tomar la foto
                            $boton.addEventListener("click", function() {

                                //Pausar reproducción
                                $video.pause();

                                //Obtener contexto del canvas y dibujar sobre él
                                let contexto = $canvas.getContext("2d");
                                $canvas.width = $video.videoWidth;
                                $canvas.height = $video.videoHeight;
                                contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

                                let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
                                
                                $estado.innerHTML = "Enviando foto. Por favor, espera...";
                                fetch("/guardar_foto.php", {
                                        method: "POST",
                                        body: encodeURIComponent(foto)+"&{{$id_encuesta}}"+"&{{$id_empleado}}",
                                        headers: {
                                            "Content-type": "application/x-www-form-urlencoded",
                                        }
                                    })
                                    .then(resultado => {
                                        // A los datos los decodificamos como texto plano
                                        return resultado.text()
                                    })
                                    .then(nombreDeLaFoto => {
                                        // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                                        console.log("La foto fue enviada correctamente");
                                        console.log(nombreDeLaFoto);
                                        let urlfoto=nombreDeLaFoto;/* guardo nombre de la foto */
                                        $("#urlfoto").val(nombreDeLaFoto);
                                        /*  subirFotoCapturada(nombreDeLaFoto); */
                                        $estado.innerHTML = `Foto guardada con éxito. Puedes verla <a target='_blank' href='{{Request::root()}}/public_html/encuesta_im/${nombreDeLaFoto}'> aquí</a>`;
                                        $("#info_final").text("Foto "+nombreDeLaFoto+" subida correctamente")
                                        var img=document.getElementById("img_subida");
                                        img.src="{{Request::root()}}/public_html/encuesta_im/"+nombreDeLaFoto+"?"+Math.random();
                                        /* img.src="{{Request::root()}}/public_html/encuesta_im/"+nombreDeLaFoto; */
                                        $("#abrimodal2").click();
                                    })  

                                //Reanudar reproducción
                                $video.play();
                            });
                        }, (error) => {
                            console.log("Permiso denegado o error: ", error);
                            $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
                        });
                }
            })(); 
        </script>

        {{-- ajax para las fotos --}}
        <script>
            function subirfoto() {
                let id_encuesta2=$("#id_encuesta2").val();
                var parametros= new FormData($("#form_fotos")[0]);
                parametros.append("id_encuesta",id_encuesta2);
                console.log(parametros);
                $.ajax({
                data: parametros,
                url:'{{route('guardarfoto.ajax')}}',
                type:"POST",
                contentType:false,
                processData:false,
                beforesend:function(){
                },
                success: function (response) {
                    $("#urlfoto").val(response);
                    $("#input_foto").val("");
                    $("#info_final").text("Foto "+response+" subida correctamente")
                    $("#img_subida").attr("src","{{Request::root()}}/public_html/encuesta_im/"+response+"?"+Math.random());
                    $("#abrimodal2").click();
                    
                    $estado.innerHTML = `Foto Subida con éxito. Puedes verla <a target='_blank' href='{{Request::root()}}/public_html/encuesta_im/${response}'> aquí</a>`;
                }
                });
            }
        </script>
        {{-- ajax para guardar la informacion --}}
        <script>
            $("#guardar_datos").click(function (e) { 
            let id={{$id_encuesta}} ;
            let ean= $("#cean").val();
            let ruta_foto= $("#urlfoto").val();
            let longitud=  $("#longitud").val();  
            let latitud=  $("#latitud").val();
            let fecha_hora=  $("#fecha_hora").val();
            let respuestas= JSON.stringify(ObtenerRespuestas());  
            if (ean == null) {
                ean ="";
            }
            var p={
                id_encuesta_im : id,ean,ruta_foto,longitud,latitud,respuestas,fecha_hora,
            };
            // console.log(p);
            $.get('{{route('store.ajax')}}',{p},function(responseArray){
              console.log(responseArray);
              $("#info_final").text(responseArray);
              $("#img_subida").addClass("d-none");
              $("#abrimodal2").click();
              setInterval(()=>{
                window.location="{{route('encuestas')}}";
              },3000);
            });                
            });
        </script>
@endpush

@endsection