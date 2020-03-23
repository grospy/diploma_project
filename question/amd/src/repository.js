//

/**
 * A javascript module to handle question ajax actions.
 *
 * @module     core_question/repository
 * @class      repository
 * @package    core_question
 * @copyright  2017 Simey Lameze <lameze@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax'], function($, Ajax) {

    /**
     * Submit the form data for the question tags form.
     *
     * @method submitTagCreateUpdateForm
     * @param {string} formdata The URL encoded values from the form
     * @return {promise}
     */
    var submitTagCreateUpdateForm = function(questionId, contextId, formdata) {
        var request = {
            methodname: 'core_question_submit_tags_form',
            args: {
                questionid: questionId,
                contextid: contextId,
                formdata: formdata
            }
        };

        return Ajax.call([request])[0];
    };

    return {
        submitTagCreateUpdateForm: submitTagCreateUpdateForm
    };
});
