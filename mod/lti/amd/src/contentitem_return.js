//

/**
 * Processes the result of LTI tool creation from a Content-Item message type.
 *
 * @module     mod_lti/contentitem_return
 * @class      contentitem_return
 * @package    mod_lti
 * @copyright  2016 Jun Pataleta <jun@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.2
 */
define(['jquery'], function($) {
    return {
        /**
         * Init function.
         *
         * @param {string} returnData The returned data.
         */
        init: function(returnData) {
            // Make sure the window has loaded before we perform processing.
            $(window).ready(function() {
                if (window != top) {
                    // Send return data to be processed by the parent window.
                    parent.processContentItemReturnData(returnData);
                } else {
                    window.processContentItemReturnData(returnData);
                }
            });
        }
    };
});
