<?php
//

/**
 * Template plans form.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp\form;
defined('MOODLE_INTERNAL') || die();

use moodleform;
use core\form\persistent;

require_once($CFG->libdir . '/formslib.php');

/**
 * Template plans form class.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class template_plans extends moodleform {

    public function definition() {
        $mform = $this->_form;

        $options = array(
            'ajax' => 'tool_lp/form-user-selector',
            'multiple' => true,
            'data-capability' => 'moodle/competency:planmanage'
        );
        $mform->addElement('autocomplete', 'users', get_string('selectuserstocreateplansfor', 'tool_lp'), array(), $options);
        $mform->addElement('submit', 'submit', get_string('createplans', 'tool_lp'));
    }

}
