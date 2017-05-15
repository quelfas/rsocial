<style>

.example {
  padding: 10px;
  border: 1px solid #ccc;
}
#drop_zone {
  border: 2px dashed #bbb;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  padding: 25px;
  text-align: center;
  font: 20pt bold 'Vollkorn';
  color: #bbb;
}
.thumb {
  height: 75px;
  border: 1px solid #000;
  margin: 10px 5px 0 0;
}
#progress_bar {
  margin: 10px 0;
  padding: 3px;
  border: 1px solid #000;
  font-size: 14px;
  clear: both;
  opacity: 0;
  -o-transition: opacity 1s linear;
  -moz-transition: opacity 1s linear;
  -webkit-transition: opacity 1s linear;
  -ms-transition: opacity 1s linear;
}
#progress_bar.loading {
  opacity: 1.0;
}
#progress_bar .percent {
  background-color: #99ccff;
  height: auto;
  width: 0;
}
#byte_content {
  margin: 5px 0;
  max-height: 100px;
  overflow-y: auto;
  overflow-x: hidden;
}
#byte_range {
  margin-top: 5px;
}
</style>

<script type="text/javascript">
// Check for the various File API support.
if (window.File && window.FileReader && window.FileList && window.Blob) {
// Great success! All the File APIs are supported.
} else {
  alert('Tu navegador no soporta ciertas funcionalidades');
}
</script>
  

    <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tu estado</a></li>
    <li role="presentation"><a href="#videos" aria-controls="videos" role="tab" data-toggle="tab">Videos</a></li>
    <li role="presentation"><a href="#imagenes" aria-controls="imagenes" role="tab" data-toggle="tab">Imagenes</a></li>
    {{--<li role="presentation"><a href="#mensajes" aria-controls="mensajes" role="tab" data-toggle="tab">Mensajes</a></li>--}}
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="home">

    <h3>Actividad</h3>

    @forelse($contenidos as $contenido)
      <p @if($contenido->content_type === "Help")
          class = 'text-success'
         @else
          class = 'text-primary'
         @endif
        >
        {{ $contenido->created_at->day }}/{{ $contenido->created_at->month }}/{{ $contenido->created_at->year }}
        
        @if($contenido->content_type === "Help")
            <i class="fa fa-info-circle" aria-hidden="true"></i> Generada 
        @elseif($contenido->content_type === "Video")
            <i class="fa fa-video-camera" aria-hidden="true"></i> Nuevo 
        @elseif($contenido->content_type === "videos")
            <i class="fa fa-video-camera" aria-hidden="true"></i> Video 
        @elseif($contenido->content_type === "Galery")
            <i class="fa fa-picture-o" aria-hidden="true"></i> Galeria 
        @elseif($contenido->content_type === "Photo")
            <i class="fa fa-picture-o" aria-hidden="true"></i> Foto 
        @else
            Contenido agregado
        @endif
        &nbsp;{{$contenido->tags}}
      </p>

    @empty
      <small>No hay Actividad</small>
    @endforelse

    </div>



    <div role="tabpanel" class="tab-pane" id="videos">


      <h3>Tus videos</h3>
      @forelse($videos as $video)
        <a href="#VideoModal" data-toggle="modal" data-whatever="{{ $video->url_frame}} "><img src="https://img.youtube.com/vi/{{ $video->url_link }}/3.jpg" alt="" data-toggle="tooltip" data-placement="bottom" title="{{$video->tags}}"></a>&nbsp;
      @empty
        Ningun video para mostrar.
      @endforelse

      {{--modal video--}}
      <div class="modal fade" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <iframe id="youtubeId" src="" width="560" height="315"></iframe>
        </div>
      </div>

      <script type="text/javascript">
      $('#VideoModal').on('show.bs.modal', function (event) {
      var alias = $(event.relatedTarget) // Button that triggered the modal
      var frameDir = alias.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $('#youtubeId').attr('src',frameDir);
      })

      $('#VideoModal').on('hidden.bs.modal', function (event){
        $('#youtubeId').attr('src',null);
      })
      </script>
      {{--modal video--}}

      <h3>Inserte un Video</h3>

      <form class="form-inline" action="/videos" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
          <div class="input-group">

            <div class="input-group-addon">
              <i class="fa fa-youtube fa-1x" aria-hidden="true"></i>
            </div>

            <input name="link" v-model="link" type="text" class="form-control" placeholder="Pega tu video">
            <input type="hidden" v-bind:value="link | youtube" name="source">
            <input type="hidden" v-bind:value="link | youtubeName" name="nameId">

          </div>

          <button type="submit" class="btn btn-primary">Guardar</button>
          <button v-on:click="limpiarFormVideo()" type="reset" class="btn btn-danger">Limpiar</button>

        </div>
        <hr>

          <label for="publico" data-toggle="tooltip" data-placement="top" title="(On) Solo sera visible para ti">Privado:&nbsp;</label>
          <input type="checkbox" name="publico">

          <label for="restringido" data-toggle="tooltip" data-placement="top" title="(On) No apto para menores o personas suceptibles">Control Parental:&nbsp;</label>
          <input type="checkbox" name="restringido">
          <br>
          <br>
          <input type="text" name="tags" placeholder="Titulo" class="form-control">

        <hr>

        <div v-show="link | youtube" class="embed-container">

          <iframe width="560" height="315" v-bind:src="link | youtube" frameborder="0" allowfullscreen></iframe>

        </div>
          <hr>
          <button v-show="link | youtube" type="button" class="btn btn-danger" name="button" data-toggle="popover" title="URL" v-bind:data-content="link"><i v-show="link | youtube" class="fa fa-code fa-fw fa-lg" aria-hidden="true"></i></button>
      </form>


    </div>


    <div role="tabpanel" class="tab-pane" id="imagenes">
      <script type="text/javascript" src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
      <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}" />
      <span data-dz-name></span>
      <h3>Imagenes de Perfil</h3>

      {{--galeria perfil--}}
        @forelse($galeriasPerfil as $galeriaPerfil)


          <img class="img-circle" width="70" height="70" src="{{ asset('assets/upload/') }}/{{ $galeriaPerfil->image_name }}" alt="">

        @empty
          No hay imagenes de perfil aun
        @endforelse
      {{--galeria perfil--}}
      <hr>
      <h3>Galeria de Imagenes</h3>
      {{--galerias col-sm-6 col-md-4--}}
        <div class="row">


        @forelse($contenidos as $contenido)
        <?php   $imagen_idGalery = explode("-",$contenido->content_id); ?>
              @foreach($galerias as $galeria)
                @if($imagen_idGalery[0] == $galeria->id)

                <div class="col-md-6">
                {{--MediaObjetc--}}
                <div class="media">
                  <div class="media-left">
                    <a href="#M<?php echo md5($contenido->content_id);?>" data-toggle="modal">
                      <img width="64" class="media-object" src="{{ asset('assets/upload/') }}/{{ $galeria->image_name }}" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">{{ $contenido->tags }}</h4>
                    Galeria Creada el: {{ $contenido->created_at->toDayDateTimeString() }}
                    <br>
                    

                    <form class="form-inline" action="/content/{{ $contenido->id }}" method="POST">
                    <a class="btn btn-info btn-xs" href="#M<?php echo md5($contenido->content_id);?>" data-toggle="modal" role="button">Ver</a>
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="delete">
                      <input class="btn btn-danger btn-xs" type="submit" value="Eliminar">
                      <a href="content/{{ $contenido->id }}">
                       @if($contenido->privacy == 'publico')
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color:blue" data-toggle="tooltip" data-placement="right" title="Galeria Publica"></span>
                       @else
                          <span class="glyphicon glyphicon-eye-close" aria-hidden="true" style="color:red" data-toggle="tooltip" data-placement="right" title="Galeria Privada"></span>
                       @endif
                       </a>
                    </form>
                     
                  </div>
                </div>
                {{--MediaObjetc--}}
                <hr>
                </div>

                  {{--modal--}}
                  <div class="modal fade" id="M<?php echo md5($contenido->content_id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">

                    {{--carrusel--}}
                    <div id="<?php echo md5($contenido->content_id);?>" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                      {{--Indicador de imagenes--}}
                       <?php
                            $dataSlide = 0;
                            foreach($galerias as $galeria){
                                if(in_array($galeria->id, $imagen_idGalery)){
                                    ?>
                                        <li 
                                            data-target="#<?php echo md5($contenido->content_id);?>" 
                                            data-slide-to="{{ $dataSlide }}"
                                            <?php if($dataSlide == 0){ echo "class='active'"; }?>>        
                                        </li>
                                    <?php
                                    $dataSlide ++;
                                }
                            }  
                        ?> 
                        
                        {{--Indicador de imagenes--}}
                      </ol>
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                      <?php
                        $trigger = 0;
                        foreach($galerias as $galeria) {
                          if(in_array($galeria->id, $imagen_idGalery)) {
                            ?>


                              <div class="<?php if($trigger == 0){ echo "item active"; }else{ echo "item"; } ?>">
                                <img class="img-responsive" src="{{asset('assets/upload/')}}/{{$galeria->image_name}}" alt="Creado el {{$contenido->created_at->toDayDateTimeString()}}">
                                <div class="carousel-caption">
                                  <h3>{{$contenido->tags}}</h3>
                                  <p>{{$contenido->created_at->toDayDateTimeString()}}</p>
                                </div>
                              </div>

                            <?php
                            $trigger ++;
                          }
                        }

                       ?>
                     </div>
                      <!-- Controls -->
                      <a class="left carousel-control" href="#<?php echo md5($contenido->content_id);?>" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#<?php echo md5($contenido->content_id);?>" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    {{--carrusel--}}

                    </div>
                  </div>
                  </div>
                  {{--modal--}}

                @endif
              @endforeach
          {{--falta cargar las imagenes en modal--}}
          {{--imagen en thumbnail--}}
        @empty
          No existen Galerias creadas
        @endforelse


       </div>
      {{--galerias--}}

      <h3>Crea una Nueva Galeria</h3>
          <!-- INICIO DROPZONE -->
          <form action="/upload" method="POST" id="my-dropzone" class="dropzone" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="text" v-model="count" name="mascara" class="form-control" placeholder="Nombre de la Galeria">
            <br>
            <input type="text" name="tags" class="form-control" placeholder="Etiquetas">
            <input name="galeria" type="hidden" :value="count">
            <br>
            <label for="privacy">Privacidad: </label> <input type="checkbox" name="privacy">
            <hr>
            <div class="dz-message">
              Arrastra tus imagenes aqui
            </div>
            <div class="dropzone-preview"></div>
             <button type="submit" :disabled="count == ''" class="btn btn-success" id="submit"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Subir</button>
          </form>
          <p class="text-right"><small id="count"></small></p>
          <!--script -->
          <script type="text/javascript">
          var archivos = 0;
            Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 3,
            maxFiles: 15,
            addRemoveLinks: true,

            init: function() {
                    var submitBtn = document.querySelector("#submit");
                    myDropzone = this;

                    submitBtn.addEventListener("click", function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });

                    this.on("addedfile", function(file) {
                        //cuenta de eventos addedfiles disparados

                        if (archivos === 0) {
                          archivos = 1;
                        } else {
                          archivos++;
                        }

                        $("#count").text('Cantidad de archivos: ' + archivos + '/20');

                    });

                    this.on("success", function(file) {
                      //limpieza
                        this.removeFile(file);
                        archivos = 0;
                        $("#count").text('Cantidad de archivos: ' + archivos + '/20');
                        $(".form-control").val('');

                    });

                    this.on("success", myDropzone.processQueue.bind(myDropzone));
                    this.on("success", function(file, response){
                      
                      var newHTML = [];
                      for (var i = 0; i <response.length; i++) {
                          newHTML.push('<span>' + response[i] + '</span><br>');
                      }
                      $(".dz-message").html(newHTML.join(""));

                    });

                  }
              };

          </script>
        <!--script -->
          <!-- FIN DROPZONE -->
    </div>


    <div role="tabpanel" class="tab-pane" id="mensajes">...</div>
  </div>

</div>