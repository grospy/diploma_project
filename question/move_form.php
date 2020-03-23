<?php
//

/**
 * Form for moving questions between categories.
 *
 * @package    moodlecore
 * @subpackage questionbank
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');


/**
 * Form for moving questions between categories.
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_move_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;

        $currentcat = $this->_customdata['currentcat'];
        $contexts = $this->_customdata['contexts'];

        $mform->addElement('questioncategory', 'category', get_string('category', 'question'), compact('contexts', 'currentcat'));

        $this->add_action_buttons(true, get_string('categorymoveto', 'question'));

        $mform->addElement('hidden', 'delete', $currentcat);
        $mform->setType('delete', PARAM_INT);
    }
}
