<?php
//

/**
 * A step designed to be orphaned.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_usertours\local\target;

defined('MOODLE_INTERNAL') || die();

use tool_usertours\step;

/**
 * A step designed to be orphaned.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class unattached extends base {
    /**
     * @var     array       $forcedsettings The settings forced by this type.
     */
    protected static $forcedsettings = [
            'placement'     => 'top',
            'orphan'        => true,
            'reflex'        => false,
        ];

    /**
     * Convert the target value to a valid CSS selector for use in the
     * output configuration.
     *
     * @return string
     */
    public function convert_to_css() {
        return '';
    }

    /**
     * Convert the step target to a friendly name for use in the UI.
     *
     * @return string
     */
    public function get_displayname() {
        return get_string('target_unattached', 'tool_usertours');
    }

    /**
     * Add the target type configuration to the form.
     *
     * @param   MoodleQuickForm $mform      The form to add configuration to.
     * @return  $this
     */
    public static function add_config_to_form(\MoodleQuickForm $mform) {
        // There is no relevant value here.
        $mform->addElement('hidden', 'targetvalue_unattached', '');
        $mform->setType('targetvalue_unattached', PARAM_TEXT);
    }

    /**
     * Add the disabledIf values.
     *
     * @param   MoodleQuickForm $mform      The form to add configuration to.
     */
    public static function add_disabled_constraints_to_form(\MoodleQuickForm $mform) {
        $myvalue = \tool_usertours\target::get_target_constant_for_class(get_class());

        foreach (array_keys(self::$forcedsettings) as $settingname) {
            $mform->hideIf($settingname, 'targettype', 'eq', $myvalue);
        }
    }

    /**
     * Prepare data to submit to the form.
     *
     * @param   object          $data       The data being passed to the form
     */
    public function prepare_data_for_form($data) {
        $data->targetvalue_unattached = '';
    }

    /**
     * Fetch the targetvalue from the form for this target type.
     *
     * @param   stdClass        $data       The data submitted in the form
     * @return  string
     */
    public function get_value_from_form($data) {
        return '';
    }
}
