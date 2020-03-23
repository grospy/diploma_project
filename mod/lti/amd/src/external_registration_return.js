//

/**
 * Handles the return params from the external registration page after it
 * redirects back to Moodle.
 *
 * See also: mod/lti/externalregistrationreturn.php
 *
 * @module     mod_lti/external_registration_return
 * @class      external_registration_return
 * @package    mod_lti
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.1
 */
define([], function() {

    return /** @alias module:mod_lti/external_registration_return */ {

        /**
         * If this was rendered in an iframe then trigger the external registration
         * complete behaviour in the parent page and provide the params returned from
         * the external registration page.
         *
         * @param {String} message The registration message from the external registration page
         * @param {String} error The registration error message from the external registration page, if
         *                     there was an error.
         * @param {Integer} id The tool proxy id for the external registration.
         * @param {String} status Whether the external registration was successful or not.
         */
        init: function(message, error, id, status) {
            if (window.parent) {
                window.parent.triggerExternalRegistrationComplete({
                    message: message,
                    error: error,
                    id: id,
                    status: status
                });
            }
        }
    };
});
