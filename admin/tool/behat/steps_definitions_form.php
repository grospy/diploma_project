<?php
//

/**
 * Steps definitions form
 *
 * @package    tool_behat
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Form to display the available steps definitions
 *
 * @package    tool_behat
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class steps_definitions_form extends moodleform {

    /**
     * Form definition
     * @return void
     */
    public function definition() {
        global $PAGE;

        $mform = $this->_form;
        $output = $PAGE->get_renderer('tool_behat');

        $mform->addElement('header', 'info', get_string('infoheading', 'tool_behat'));
        $mform->setExpanded('info', false);
        $mform->addElement('html', $output->generic_info());

        $mform->addElement('header', 'filters', get_string('stepsdefinitionsfilters', 'tool_behat'));

        $types = array(
            '' => get_string('allavailablesteps', 'tool_behat'),
            'given' => get_string('giveninfo', 'tool_behat'),
            'when' => get_string('wheninfo', 'tool_behat'),
            'then' => get_string('theninfo', 'tool_behat')
        );
        $mform->addElement('select', 'type', get_string('stepsdefinitionstype', 'tool_behat'), $types);

        $mform->addElement(
            'select',
            'component',
            get_string('stepsdefinitionscomponent', 'tool_behat'),
            $this->_customdata['components']
        );

        $mform->addElement('text', 'filter', get_string('stepsdefinitionscontains', 'tool_behat'));
        $mform->setType('filter', PARAM_NOTAGS);

        $mform->addElement('submit', 'submit', get_string('viewsteps', 'tool_behat'));
    }
}
