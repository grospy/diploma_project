<?php
//

/**
 * This file contains the form export a competency framework.
 *
 * @package   tool_lpimportcsv
 * @copyright 2015 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lpimportcsv\form;

defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

use moodleform;
use context_system;
use core_competency\api;

require_once($CFG->libdir.'/formslib.php');

/**
 * Export Competency framework form.
 *
 * @package   tool_lpimportcsv
 * @copyright 2015 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class export extends moodleform {

    /**
     * Define the form - called by parent constructor
     */
    public function definition() {
        $mform = $this->_form;

        $context = context_system::instance();
        $frameworks = api::list_frameworks('shortname', 'ASC', null, null, $context);
        $options = array();
        foreach ($frameworks as $framework) {

            $options[$framework->get('id')] = $framework->get('shortname');
        }
        if (empty($options)) {
            $mform->addElement('static', 'frameworkid', '', get_string('noframeworks', 'tool_lpimportcsv'));
        } else {
            $mform->addElement('select', 'frameworkid', get_string('competencyframework', 'tool_lp'), $options);
            $mform->setType('frameworkid', PARAM_INT);
            $mform->addRule('frameworkid', null, 'required', null, 'client');
            $this->add_action_buttons(true, get_string('export', 'tool_lpimportcsv'));
        }
        $mform->setDisableShortforms();
    }

}
