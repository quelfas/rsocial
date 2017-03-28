var match = null;
Vue.filter('youtube', function(url){

  var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
  var match = url.match(regExp);
  var youtube = 'https://www.youtube.com/embed';
  if (match && match[2].length == 11) {
    return youtube +'/'+ match[2];
  } else {
    //error
    return null;
  }

}),

Vue.filter('youtubeName', function(url){
   
  var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
  var match = url.match(regExp);
  var youtube = 'https://www.youtube.com/embed';
  if (match && match[2].length == 11) {
    return match[2];
  } else {
    //error
    return null;
  }

}),

Vue.filter('textoCapital',function(texto){
  return texto && texto[0].toUpperCase() + texto.slice(1).toLowerCase();
})

  new Vue({
    el: "body",
    data: {
      link: '',
      status:'',
      count:''

    },
    methods:{
      limpiarFormVideo: function(){
        this.link         ='';
      },
      limpiarFormStatus: function(){
        this.status       ='';
      }
    }
  });
