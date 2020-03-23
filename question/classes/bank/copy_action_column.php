<?php
//

/**
 * Question bank column for the duplicate action icon.
 *
 * @package   core_question
 * @copyright 2013 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * Question bank column for the duplicate action icon.
 *
 * @copyright 2013 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class copy_action_column extends menu_action_column_base {
    /** @var string avoids repeated calls to get_string('duplicate'). */
    protected $strcopy;

    public function init() {
        parent::init();
        $this->strcopy = get_string('duplicate');
    }

    public function get_name() {
        return 'copyaction';
    }

    protected function get_url_icon_and_label(\stdClass $question): array {
        // To copy a question, you need permission to add a question in the same
        // category as the existing question, and ability to access the details of
        // the question being copied.
        if (question_has_capability_on($question, 'add') &&
                (question_has_capability_on($question, 'edit') || question_has_capability_on($question, 'view'))) {
            return [$this->qbank->copy_question_moodle_url($question->id), 't/copy', $this->strcopy];
        }
        return [null, null, null];
    }
}
