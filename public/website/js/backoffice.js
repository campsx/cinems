$(document).ready(function() {

    var hamburguer = $('.close');
    $('.open-left').click(function(){
        hamburguer.toggleClass('close');
    });

    var settings = $('.dropdown-toggle');
    settings.click(function(e){
        e.preventDefault();
        $('.dropdown').toggleClass('open');
    });

});
