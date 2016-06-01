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

      <h3>Galeria de Imagenes</h3>
          <div id="actions" class="row">

        <div class="col-lg-7">
          <!-- The fileinput-button span is used to style the file input field as button -->
          <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Agregar Archivo</span>
          </span>
          <button type="submit" class="btn btn-primary start">
              <i class="glyphicon glyphicon-upload"></i>
              <span>Iniciar Carga</span>
          </button>
          <button type="reset" class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancelar Carga</span>
          </button>
        </div>

        <div class="col-lg-5">
          <!-- The global file processing state -->
          <span class="fileupload-process">
            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
          </span>
        </div>

      </div>


      <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
      <div class="table table-striped" class="files" id="previews">
        
        <label for="galeria">Nombre de la Galeria:</label>
        <input type="text" class="form-control" name="galeria">

      <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
        <div>
            <span class="preview"><img data-dz-thumbnail /></span>
        </div>
        <div>
            <p class="name" data-dz-name></p>
            <strong class="error text-danger" data-dz-errormessage></strong>
        </div>
        <div>
            <p class="size" data-dz-size></p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
        </div>
        <div>
          <button class="btn btn-primary start">
              <i class="glyphicon glyphicon-upload"></i>
              <span>Iniciar</span>
          </button>
          <button data-dz-remove class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancelar</span>
          </button>
          <button data-dz-remove class="btn btn-danger delete">
            <i class="glyphicon glyphicon-trash"></i>
            <span>Eliminar</span>
          </button>
        </div>
      </div>

      </div>
      <script type="text/javascript">
      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/imageup", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0";
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
        };
      </script>
    </div>


    <div role="tabpanel" class="tab-pane" id="mensajes">...</div>
  </div>

</div>
