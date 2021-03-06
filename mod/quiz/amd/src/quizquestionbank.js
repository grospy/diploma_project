//

/**
 * Initialise the question bank modal on the quiz page.
 *
 * @module    mod_quiz/quizquestionbank
 * @package   mod_quiz
 * @copyright 2018 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(
    [
        'mod_quiz/add_question_modal_launcher',
        'mod_quiz/modal_quiz_question_bank'
    ],
    function(
        AddQuestionModalLauncher,
        ModalQuizQuestionBank
    ) {

    return {
        /**
         * Create the question bank modal.
         *
         * @param  {int} contextId Current context id.
         */
        init: function(contextId) {
            AddQuestionModalLauncher.init(
                ModalQuizQuestionBank.TYPE,
                '.menu [data-action="questionbank"]',
                contextId
            );
        }
    };
});
