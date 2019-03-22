$(document).ready(function(){
  $('#up').fadeOut();

    $(window).scroll(function(){
    if ($(this).scrollTop() > 50) {
      $('#up').fadeIn();
    } else {
      $('#up').fadeOut();
    }
  });
  $('#up').click(function(){
    $('html, body').animate({scrollTop : 0},800);
    return false;
  });
});