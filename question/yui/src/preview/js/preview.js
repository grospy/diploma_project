//

/*
 * @copyright 2014 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * JavaScript required by the question preview pop-up.
 *
 * @module moodle-question-preview
 */

M.question = M.question || {};
M.question.preview = M.question.preview || {};

/*
 * Initialise JavaScript-specific parts of the question preview popup.
 */
M.question.preview.init = function() {
    M.core_question_engine.init_form(Y, '#responseform');

    // Add a close button to the window.
    var closebutton = Y.Node.create('<input type="button" class="btn btn-secondary"/>')
            .set('value', M.util.get_string('closepreview', 'question'));

    closebutton.on('click', function() {
        window.close();
    });
    Y.one('#previewcontrols').append(closebutton);

    // Stop a question form being submitted more than once.
    Y.on('submit', M.core_question_engine.prevent_repeat_submission, '#mform1', null, Y);
};
