$(document).ready(function() {
    $('#ticket-container .ticket').each(function(index){
        var _this = this;
        setTimeout(function() {
            $(_this).fadeIn('slow');
        }, 250*index );
    });
});