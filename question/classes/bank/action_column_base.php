<?php
//

/**
 * A base class for actions that are an icon that lets you manipulate the question in some way.
 *
 * @package   core_question
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * A base class for actions that are an icon that lets you manipulate the question in some way.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class action_column_base extends column_base {

    protected function get_title() {
        return '&#160;';
    }

    public function get_extra_classes() {
        return array('iconcol');
    }

    protected function print_icon($icon, $title, $url) {
        global $OUTPUT;
        echo '<a title="' . $title . '" href="' . $url . '">' . $OUTPUT->pix_icon($icon, $title) . '</a>';
    }

    public function get_extra_joins() {
        return array('qc' => 'JOIN {question_categories} qc ON qc.id = q.category');
    }

    public function get_required_fields() {
        // Createdby is required for permission checks.
        return array('q.id', 'q.createdby', 'qc.contextid');
    }
}
