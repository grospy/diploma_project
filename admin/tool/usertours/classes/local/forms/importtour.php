<?php
//

/**
 * Form for editing tours.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_usertours\local\forms;

defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

require_once($CFG->libdir . '/formslib.php');

/**
 * Form for importing tours.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class importtour extends \moodleform {
    /**
     * Create the import tour form.
     */
    public function __construct() {
        parent::__construct(\tool_usertours\helper::get_import_tour_link());
    }

    /**
     * Form definition.
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('filepicker', 'tourconfig', get_string('tourconfig', 'tool_usertours'));
        $mform->addRule('tourconfig', null, 'required');

        $this->add_action_buttons();
    }
}
