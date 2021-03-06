<?php
//

/**
 * Profiling tool import utility form.
 *
 * @package    tool_profiling
 * @copyright  2013 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class profiling_import_form extends moodleform {
    public function definition () {
        global $CFG;

        $mform = $this->_form;

        $mform->addElement('header', 'settingsheader', get_string('upload'));

        $mform->addElement('filepicker', 'mprfile', get_string('file'), null, array('accepted_types' => array('.mpr', '.zip')));
        $mform->addRule('mprfile', null, 'required');

        $mform->addElement('text', 'importprefix',
                get_string('importprefix', 'tool_profiling'), array('size' => 10));
        $mform->setDefault('importprefix', $CFG->profilingimportprefix);
        $mform->setType('importprefix', PARAM_TAG);

        $this->add_action_buttons(false, get_string('import', 'tool_profiling'));
    }
}
