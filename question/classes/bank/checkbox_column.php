<?php
//

/**
 * A column with a checkbox for each question with name q{questionid}.
 *
 * @package   core_question
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();

use core\output\checkbox_toggleall;


/**
 * A column with a checkbox for each question with name q{questionid}.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class checkbox_column extends column_base {

    public function get_name() {
        return 'checkbox';
    }

    protected function get_title() {
        global $OUTPUT;

        $mastercheckbox = new checkbox_toggleall('qbank', true, [
            'id' => 'qbheadercheckbox',
            'name' => 'qbheadercheckbox',
            'value' => '1',
            'label' => get_string('selectall'),
            'labelclasses' => 'accesshide',
        ]);

        return $OUTPUT->render($mastercheckbox);
    }

    protected function get_title_tip() {
        return get_string('selectquestionsforbulk', 'question');
    }

    protected function display_content($question, $rowclasses) {
        global $OUTPUT;

        $checkbox = new checkbox_toggleall('qbank', false, [
            'id' => "checkq{$question->id}",
            'name' => "q{$question->id}",
            'value' => '1',
            'label' => get_string('select'),
            'labelclasses' => 'accesshide',
        ]);

        echo $OUTPUT->render($checkbox);
    }

    public function get_required_fields() {
        return array('q.id');
    }
}
