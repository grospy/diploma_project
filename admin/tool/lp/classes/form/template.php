<?php
//

/**
 * This file contains the form add/update a competency framework.
 *
 * @package   tool_lp
 * @copyright 2015 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp\form;
defined('MOODLE_INTERNAL') || die();

use core\form\persistent;

/**
 * Learning plan template form.
 *
 * @package   tool_lp
 * @copyright 2015 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class template extends persistent {

    protected static $persistentclass = 'core_competency\\template';

    /**
     * Define the form - called by parent constructor
     */
    public function definition() {
        $mform = $this->_form;

        $context = $this->_customdata['context'];

        $mform->addElement('hidden', 'contextid');
        $mform->setType('contextid', PARAM_INT);
        $mform->setConstant('contextid', $context->id);

        $mform->addElement('header', 'generalhdr', get_string('general'));

        // Name.
        $mform->addElement('text', 'shortname', get_string('shortname', 'tool_lp'), 'maxlength="100"');
        $mform->setType('shortname', PARAM_TEXT);
        $mform->addRule('shortname', null, 'required', null, 'client');
        $mform->addRule('shortname', get_string('maximumchars', '', 100), 'maxlength', 100, 'client');
        // Description.
        $mform->addElement('editor', 'description',
                           get_string('description', 'tool_lp'), array('rows' => 4));
        $mform->setType('description', PARAM_CLEANHTML);
        $mform->addElement('selectyesno', 'visible',
                           get_string('visible', 'tool_lp'));
        $mform->addElement('date_time_selector',
                           'duedate',
                           get_string('duedate', 'tool_lp'),
                           array('optional' => true));
        $mform->addHelpButton('duedate', 'duedate', 'tool_lp');

        $mform->setDefault('visible', true);
        $mform->addHelpButton('visible', 'visible', 'tool_lp');

        $mform->addElement('static', 'context', get_string('category', 'tool_lp'));
        $mform->setDefault('context', $context->get_context_name(false));
        // Disable short forms.
        $mform->setDisableShortforms();

        $this->add_action_buttons(true, get_string('savechanges', 'tool_lp'));

    }

}
