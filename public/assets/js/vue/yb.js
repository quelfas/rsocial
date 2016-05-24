Vue.filter('youtube', function(url){
  //var separo =  value.split('watch?v=');
  //return separo.join('embed/');
  var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
  var match = url.match(regExp);
  var youtube = 'https://www.youtube.com/embed';
  if (match && match[2].length == 11) {
    return youtube +'/'+ match[2];
  } else {
    //error
  }

})

  new Vue({
    el: "body",
    data: {
      message: ''
    },
    methods:{
      limpiarForm: function(event){
        this.message ='';
      }
    }
  });
