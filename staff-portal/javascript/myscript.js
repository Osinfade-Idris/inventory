function _view_menu() {
    $('.side-nav-div, .flash-out-div, .slide-back-div').fadeIn(500);
}

function _hide_menu() {
    $('.side-nav-div, .flash-out-div, .slide-back-div').fadeOut(500);
}


function _expand_link(divid) {
    $('#' + divid).toggle(300)
}




$(document).ready(function() {
    setInterval(function() { _get_PHP_current_time() }, 1000);
});

function _get_PHP_current_time() {
    $.ajax({
        url: "../connection/code.php?action=date_time",
        success: function(html) {
            $("#datetime").html(html);
        }
    });
}