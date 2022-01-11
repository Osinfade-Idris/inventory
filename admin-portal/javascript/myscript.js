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







function product_search(category_id) {
    var product_search_txt = $('#product_search_txt').val();
    var request_data = 'category_id=' + category_id + '&product_search_txt=' + product_search_txt;
    $.ajax({
        type: "POST",
        url: "../connection/code.php?action=perform_product_search",
        data: request_data,
        cache: false,
        success: function(html) {
            $(".product-details-div").html(html);
        }
    });

}







function add_product() {
    $.ajax({
        url: "../connection/code.php?action=perform_add_product",
        success: function(html) {
            $(".menu-div").html(html);
        }
    });
}