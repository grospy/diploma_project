<?php
//


/**
 * Form for blog preferences
 *
 * @package    moodlecore
 * @subpackage blog
 * @copyright  2009 Nicolas Connault
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    //  It must be included from a Moodle page.
}

require_once($CFG->libdir.'/formslib.php');

class blog_preferences_form extends moodleform {
    public function definition() {
        global $USER, $CFG;

        $mform    =& $this->_form;
        $strpagesize = get_string('pagesize', 'blog');

        $mform->addElement('text', 'pagesize', $strpagesize);
        $mform->setType('pagesize', PARAM_INT);
        $mform->addRule('pagesize', null, 'numeric', null, 'client');
        $mform->setDefault('pagesize', 10);

        $this->add_action_buttons();
    }
}
