/**
 * Created by Robert Blahut on 5/16/2017.
 */

//-- SmoothState Initialization --//
var getLocation = function(href) {
    var l = document.createElement("a");
    l.href = href;
    return l;
};


$(function(){
    'use strict';
    var $page = $('#main'),
        options = {
            debug: false,
            prefetch: false,
            cacheLength: 2,
            onStart: {
                duration: 250, // Duration of our animation
                render: function ($container) {
                    // Add your CSS animation reversing class
                    $container.addClass('is-exiting');
                    // Restart your animation
                    smoothState.restartCSSAnimations();

                }
            },
            onReady: {
                duration: 0,
                render: function ($container, $newContent) {
                    // Remove your CSS animation reversing class
                    $container.removeClass('is-exiting');
                    // Inject the new content
                    $container.html($newContent);
                }
            },
            onProgress: {
                duration: 0,
                render: function ($container) {
                    $('#content-container').html("<img src='/assets/images/preloaders/loader_x65.gif' class='loading'><br />");
                }
            },
            onAfter: function ($container) {
                var path = getLocation(smoothState.href).pathname;
                $('#match-candidate.reveal').find('input[name=path]').val(path);
                $(document).foundation();
            }
        },
        smoothState = $page.smoothState(options).data('smoothState');
});