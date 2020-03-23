<?php
//

/**
 * Base class for question bank columns that just contain an action icon.
 *
 * @package   core_question
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * Base class for question bank columns that just contain an action icon.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class edit_action_column extends menu_action_column_base {
    protected $stredit;
    protected $strview;

    public function init() {
        parent::init();
        $this->stredit = get_string('editquestion', 'question');
        $this->strview = get_string('view');
    }

    public function get_name() {
        return 'editaction';
    }

    protected function get_url_icon_and_label(\stdClass $question): array {
        if (question_has_capability_on($question, 'edit')) {
            return [$this->qbank->edit_question_moodle_url($question->id), 't/edit', $this->stredit];
        } else if (question_has_capability_on($question, 'view')) {
            return [$this->qbank->edit_question_moodle_url($question->id), 'i/info', $this->strview];
        } else {
            return [null, null, null];
        }
    }
}
