jQuery(document).ready(function($) {

    $('.open-search').click(function (e) {
        console.log("clicked");
        e.preventDefault();

        var nav_search_bar = $('.nav-search-bar');
        nav_search_bar.find('button').hide();
        nav_search_bar.slideToggle();
    });

});

