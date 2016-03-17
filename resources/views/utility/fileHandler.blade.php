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
