//

/**
 * Simple method to check for changes to a form between two points in time.
 *
 * @module     mod_assign/grading_form_change_checker
 * @package    mod_assign
 * @copyright  2016 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.1
 */
define(['jquery'], function($) {

    return /** @alias module:mod_assign/grading_form_change_checker */ {
        /**
         * Save the values in the form to a data attribute so they can be compared later for changes.
         *
         * @method saveFormState
         * @param {String} selector The selector for the form element.
         */
        saveFormState: function(selector) {
            $(selector).trigger('save-form-state');
            var data = $(selector).serialize();
            $(selector).data('saved-form-state', data);
        },

        /**
         * Compare the current values in the form to the previously saved state.
         *
         * @method checkFormForChanges
         * @param {String} selector The selector for the form element.
         * @return {Boolean} True if there are changes to the form data.
         */
        checkFormForChanges: function(selector) {

            $(selector).trigger('save-form-state');

            var data = $(selector).serialize(),
                previousdata = $(selector).data('saved-form-state');

            if (typeof previousdata === 'undefined') {
                return false;
            }
            return (previousdata != data);
        }
    };
});
