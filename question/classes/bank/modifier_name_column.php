<?php
//

/**
 * A column type for the name of the question last modifier.
 *
 * @package   core_question
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * A column type for the name of the question last modifier.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class modifier_name_column extends column_base {
    public function get_name() {
        return 'modifiername';
    }

    protected function get_title() {
        return get_string('lastmodifiedby', 'question');
    }

    protected function display_content($question, $rowclasses) {
        if (!empty($question->modifierfirstname) && !empty($question->modifierlastname)) {
            $u = new \stdClass();
            $u = username_load_fields_from_object($u, $question, 'modifier');
            $date = userdate($question->timemodified, get_string('strftimedatetime', 'langconfig'));
            echo fullname($u) . '<br>' . \html_writer::tag('span', $date, array('class' => 'date'));
        }
    }

    public function get_extra_joins() {
        return array('um' => 'LEFT JOIN {user} um ON um.id = q.modifiedby');
    }

    public function get_required_fields() {
        $allnames = get_all_user_name_fields();
        $requiredfields = array();
        foreach ($allnames as $allname) {
            $requiredfields[] = 'um.' . $allname . ' AS modifier' . $allname;
        }
        $requiredfields[] = 'q.timemodified';
        return $requiredfields;
    }

    public function is_sortable() {
        return array(
            'firstname' => array('field' => 'um.firstname', 'title' => get_string('firstname')),
            'lastname' => array('field' => 'um.lastname', 'title' => get_string('lastname')),
            'timemodified' => array('field' => 'q.timemodified', 'title' => get_string('date'))
        );
    }
}
