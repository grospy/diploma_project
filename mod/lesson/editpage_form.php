<?php

//

/**
 * Generic forms used for page selection
 *
 * @package mod_lesson
 * @copyright  2009 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/

defined('MOODLE_INTERNAL') || die();

/**
 * Question selection form
 *
 * @copyright  2009 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/
class lesson_add_page_form_selection extends lesson_add_page_form_base {

    public $qtype = 'questiontype';
    public $qtypestring = 'selectaqtype';
    protected $standard = false;
    protected $manager = null;

    public function __construct($arg1, $arg2) {
        $this->manager = lesson_page_type_manager::get($arg2['lesson']);
        parent::__construct($arg1, $arg2);
    }

    public function custom_definition() {
        $mform = $this->_form;
        $types = $this->manager->get_page_type_strings(lesson_page::TYPE_QUESTION);
        asort($types);
        $mform->addElement('select', 'qtype', get_string('selectaqtype', 'lesson'), $types);
        $mform->setDefault('qtype', LESSON_PAGE_MULTICHOICE); // preselect the most common type
    }
}

/**
 * Dummy class to represent an unknown question type and direct to the selection
 * form.
 */
final class lesson_add_page_form_unknown extends lesson_add_page_form_base {}
