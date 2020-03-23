<?php
//

/**
 * Model upload form.
 *
 * @package   tool_analytics
 * @copyright 2017 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_analytics\output\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Model upload form.
 *
 * @package   tool_analytics
 * @copyright 2017 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class import_model extends \moodleform {

    /**
     * Form definition.
     *
     * @return null
     */
    public function definition () {
        $mform = $this->_form;

        $mform->addElement('header', 'settingsheader', get_string('importmodel', 'tool_analytics'));

        $mform->addElement('filepicker', 'modelfile', get_string('file'), null, ['accepted_types' => '.zip']);
        $mform->addRule('modelfile', null, 'required');

        $mform->addElement('advcheckbox', 'ignoreversionmismatches', get_string('ignoreversionmismatches', 'tool_analytics'),
            get_string('ignoreversionmismatchescheckbox', 'tool_analytics'));

        $this->add_action_buttons(true, get_string('import'));
    }
}
