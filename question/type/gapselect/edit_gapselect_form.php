<?php
//

/**
 * Defines the editing form for the select missing words question type.
 *
 * @package    qtype_gapselect
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/gapselect/edit_form_base.php');


/**
 * Select from drop down list question editing form definition.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_gapselect_edit_form extends qtype_gapselect_edit_form_base {
    /** @var array HTML tags allowed in answers (choices). */
    protected $allowedhtmltags = array();

    public function qtype() {
        return 'gapselect';
    }

    function get_maximum_choice_group_number() {
        return 20;
    }
}
