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
      <h3>Galeria de Imagenes</h3>

      <div id="drop_zone">Suelte los archivos aqui</div>
      <output id="list"></output>

      <script>
        function handleFileSelect(evt) {
          evt.stopPropagation();
          evt.preventDefault();

          var files = evt.dataTransfer.files; // FileList object.

          // files is a FileList of File objects. List some properties.
          var output = [];
          for (var i = 0, f; f = files[i]; i++) {
            output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                        f.size, ' bytes, last modified: ',
                        f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                        '</li>');
          }
          document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
        }

        function handleDragOver(evt) {
          evt.stopPropagation();
          evt.preventDefault();
          evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
        }

        // Setup the dnd listeners.
        var dropZone = document.getElementById('drop_zone');
        dropZone.addEventListener('dragover', handleDragOver, false);
        dropZone.addEventListener('drop', handleFileSelect, false);
      </script>
    </div>
    <div role="tabpanel" class="tab-pane" id="mensajes">...</div>
  </div>

</div>
