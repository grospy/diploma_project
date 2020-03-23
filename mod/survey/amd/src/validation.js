//

/**
 * Javascript to handle survey validation.
 *
 * @module     mod_survey/validation
 * @package    mod_survey
 * @copyright  2017 Dan Poltawski <dan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.3
 */
define(['jquery', 'core/str', 'core/modal_factory', 'core/notification'], function($, Str, ModalFactory, Notification) {
    return {
        /**
         * Prevents form submission until all radio buttons are chosen, displays
         * modal error if any choices are missing.
         *
         * @param {String} formid HTML id of form
         */
        ensureRadiosChosen: function(formid) {
            // Prepare modal for display in case of problems.
            var modalPromise = Str.get_strings([
                {key: 'error', component: 'moodle'},
                {key: 'questionsnotanswered', component: 'survey'},
            ]).then(function(strings) {
                return ModalFactory.create({
                    type: ModalFactory.types.CANCEL,
                    title: strings[0],
                    body: strings[1],
                });
            }).catch(Notification.exception);

            var form = $('#' + formid);
            form.submit(function(e) {
                // Look for unanswered questions..
                if (form.find('input:radio[data-survey-default="true"]:checked').length !== 0) {
                    e.preventDefault();
                    // Display the modal error.
                    return modalPromise.then(function(modal) {
                        modal.show();
                        return false;
                    });
                }

                return true;
            });
        }
    };
});
