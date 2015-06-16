/**
 * post-flagger.js
 *
 * Javascript functionality for "flag" buttons, implemented with jQuery.
 * it makes active use of wordpress' script localization and AJAX
 * for updating flag states.
 *
 * @author: Cesar Zapata <cesaros>
 * @contributors: Androide Osorio <androide-osorio>
 */

/* global post_flagger */
    'use strict';

    jQuery(document).ready(function($) {
        'use strict';

        //-------------------------------------------------------------
        /**
         * creates a POST request to wordpress' backend that will perform the desired action
         * @param action
         * @param post_id
         * @param flag_slug
         * @returns {$.promise|*}
         */
        function make_request_for(action, post_id, flag_slug) {
            var request_params = {
                action      : 'flag_post',
                flag_action :action,
                post_id     :post_id,
                flag_slug   :flag_slug
            };

            return $.post(post_flagger.flag_url, request_params);
        }

        //-------------------------------------------------------------

        //get all flag buttons in the current page
        var $flagButtons = $('.flag-this, .flagged');

        //bind the "click" event to the bind functionality
        $flagButtons.bind('click', function() {
            event.preventDefault();

            var thisButton  = $(this),
                the_post_id = thisButton.data('post-id'),
                flag_slug   = thisButton.data('flag-slug' ),
                is_flagged  = thisButton.attr('class') === 'flagged',
                flag_action = is_flagged ? 'unflag' : 'flag';

            var flagging_request = make_request_for(flag_action, the_post_id, flag_slug);

            flagging_request.done(function(data) {
                var new_class = flag_action === 'flag' ? 'flagged' : 'flag-this';

                thisButton.removeClass();
                thisButton.addClass(new_class);
                thisButton.html(data);
            });
        });


    });
