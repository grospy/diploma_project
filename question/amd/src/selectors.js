//

/**
 * The purpose of this module is to centralize selectors related to question.
 *
 * @module     core_question/question_selectors
 * @package    core_question
 * @copyright  2018 Simey Lameze <lameze@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        actions: {
            save: '[data-action="save"]',
            edittags: '[data-action="edittags"]',
        },
        containers: {
            loadingIcon: '[data-region="overlay-icon-container"]',
        },
    };
});
