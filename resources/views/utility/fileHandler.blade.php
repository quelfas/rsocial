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
    <li role="presentation"><a href="#mensajes" aria-controls="mensajes" role="tab" data-toggle="tab">Mensajes</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="home">

    <h3>Actualiza tu estado</h3>

    <form class="form-inline" action="" method="post">
      {!! csrf_field() !!}
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-comment-o fa-1x" aria-hidden="true"></i>
          </div>
          <input type="text" v-model="status" name="status" class="form-control" placeholder="Que estas pensando?">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button v-on:click="limpiarFormStatus()" type="reset" class="btn btn-danger">Limpiar</button>
      </div>
      <h4 v-show="status">@{{ status | textoCapital }}</h4>
    </form>

    </div>



    <div role="tabpanel" class="tab-pane" id="videos">

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
          <input type="text" name="tags" placeholder="Etiquetas" class="form-control">

        <hr>

        <div v-show="link | youtube" class="embed-container">

          <iframe width="560" height="315" v-bind:src="link | youtube" frameborder="0" allowfullscreen></iframe>

        </div>
          <hr>
          <button v-show="link | youtube" type="button" class="btn btn-danger" name="button" data-toggle="popover" title="URL" v-bind:data-content="link"><i v-show="link | youtube" class="fa fa-code fa-fw fa-lg" aria-hidden="true"></i></button>
      </form>

      <script src="{{asset('assets/js/vue/yb.js')}}"></script>


    </div>


    <div role="tabpanel" class="tab-pane" id="imagenes">
      <script type="text/javascript" src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
      <link rel="stylesheet" href="{{asset('assets/css/dropzone.css')}}" />

      <h3>Galeria de Imagenes</h3>
          <!-- INICIO DROPZONE -->
          <form action="/upload" method="POST" id="my-dropzone" class="dropzone" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="text" name="galeria" class="form-control" placeholder="Nombre de la Galeria">
            <br>
            <input type="text" name="tags" class="form-control" placeholder="Etiquetas">
            <br>
            <label for="privacy">Privacidad: </label> <input type="checkbox" name="privacy">
            <hr>
            <div class="dz-message">
              Arrastra tus imagenes aqui
            </div>
            <div class="dropzone-preview"></div>
             <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Subir</button>
          </form>
          <!--script -->
          <script>
            Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 15,
            
            init: function() {
                    var submitBtn = document.querySelector("#submit");
                    myDropzone = this;
                    
                    submitBtn.addEventListener("click", function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    /*this.on("addedfile", function(file) {
                        alert("file uploaded");
                    });*/
                    
                    this.on("complete", function(file) {
                        myDropzone.removeFile(file);
                    });
     
                    this.on("success", 
                        myDropzone.processQueue.bind(myDropzone)
                      );
                  }
              };
          </script>
        <!--script -->
          <!-- FIN DROPZONE -->
    </div>


    <div role="tabpanel" class="tab-pane" id="mensajes">...</div>
  </div>

</div>
