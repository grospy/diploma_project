//

/**
 * Initialise the add random question modal on the quiz page.
 *
 * @module    mod_quiz/add_random_question
 * @package   mod_quiz
 * @copyright 2018 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(
    [
        'mod_quiz/add_question_modal_launcher',
        'mod_quiz/modal_add_random_question'
    ],
    function(
        AddQuestionModalLauncher,
        ModalAddRandomQuestion
    ) {

    return {
        /**
         * Create the add random question modal.
         *
         * @param  {int} contextId Current context id.
         * @param  {string} category Category id and category context id comma separated.
         * @param  {string} returnUrl URL to return to after form submission.
         * @param  {int} cmid Current course module id.
         */
        init: function(contextId, category, returnUrl, cmid) {
            AddQuestionModalLauncher.init(
                ModalAddRandomQuestion.TYPE,
                '.menu [data-action="addarandomquestion"]',
                contextId,
                // Additional values that should be set before the modal is shown.
                function(triggerElement, modal) {
                    modal.setCategory(category);
                    modal.setReturnUrl(returnUrl);
                    modal.setCMID(cmid);
                }
            );
        }
    };
});
