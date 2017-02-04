$(document).ready(function() {

    var hamburguer = $('.close');
    $('.open-left').click(function(){
        hamburguer.toggleClass('close');
    });

    var settings = $('.dropdown');
    settings.click(function(){
        settings.toggleClass('open');
    });

});
