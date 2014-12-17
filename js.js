$(document).ready(function() {
    $('.accordion-toggle').on('click', function(e) {
        e.preventDefault();   
        if ($('#collapseCategory').hasClass('in')) {
            $('.glyphicon-chevron-up').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');;
        }else{
            $('.glyphicon-chevron-down').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }           
    });                                                               
});