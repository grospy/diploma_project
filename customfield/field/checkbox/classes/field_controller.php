<?php
//

/**
 * Customfields checkbox plugin
 *
 * @package   customfield_checkbox
 * @copyright 2018 David Matamoros <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace customfield_checkbox;

defined('MOODLE_INTERNAL') || die;

/**
 * Class field
 *
 * @package customfield_checkbox
 * @copyright 2018 David Matamoros <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_controller  extends \core_customfield\field_controller {
    /**
     * Plugin type
     */
    const TYPE = 'checkbox';

    /**
     * Add fields for editing a checkbox field.
     *
     * @param \MoodleQuickForm $mform
     */
    public function config_form_definition(\MoodleQuickForm $mform) {
        $mform->addElement('header', 'header_specificsettings', get_string('specificsettings', 'customfield_checkbox'));
        $mform->setExpanded('header_specificsettings', true);

        $mform->addElement('selectyesno', 'configdata[checkbydefault]', get_string('checkedbydefault', 'customfield_checkbox'));
        $mform->setType('configdata[checkbydefault]', PARAM_BOOL);
    }

    /**
     * Validate the data on the field configuration form
     *
     * @param array $data from the add/edit profile field form
     * @param array $files
     * @return array associative array of error messages
     */
    public function config_form_validation(array $data, $files = array()) : array {
        $errors = parent::config_form_validation($data, $files);

        if ($data['configdata']['uniquevalues']) {
            $errors['configdata[uniquevalues]'] = get_string('errorconfigunique', 'customfield_checkbox');
        }

        return $errors;
    }

    /**
     * Does this custom field type support being used as part of the block_myoverview
     * custom field grouping?
     * @return bool
     */
    public function supports_course_grouping(): bool {
        return true;
    }

    /**
     * If this field supports course grouping, then this function needs overriding to
     * return the formatted values for this.
     * @param array $values the used values that need formatting
     * @return array
     */
    public function course_grouping_format_values($values): array {
        $name = $this->get_formatted_name();
        return [
            1 => $name.': '.get_string('yes'),
            BLOCK_MYOVERVIEW_CUSTOMFIELD_EMPTY => $name.': '.get_string('no'),
        ];
    }
}
