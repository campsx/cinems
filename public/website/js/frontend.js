$(document).ready(function() {

  function hamburger_click()
{
  var hamburgerElement = document.getElementById("hamburger");
  var menuElement = document.getElementById("menu");

  hamburgerElement.style.display = "none";
  menuElement.style.display = "block";
}


    $(document).ready(function(){
        $('.navbar-fostrap').click(function(){
            $('.nav-fostrap').toggleClass('visible');
            $('body').toggleClass('cover-bg');
        });
    });

});
