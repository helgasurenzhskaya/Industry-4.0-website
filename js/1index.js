$(document).ready(function(){
  var mouseX, mouseY;
  var ww = $( window ).width();
  var wh = $( window ).height();
  var traX, traY;
  $(document).mousemove(function(e){
     mouseX = e.pageX;
     mouseY = e.pageY;
    traX = ((2 * mouseX) / 200) + 10;
    traY = ((2 * mouseY) / 200) + 30;
    $(".title").css({"background-position": traX + "%" + traY + "%"});
  });
});