<?php
//

/**
 * Customfield date plugin
 *
 * @package   customfield_date
 * @copyright 2018 David Matamoros <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace customfield_date;

defined('MOODLE_INTERNAL') || die;

/**
 * Class field
 *
 * @package customfield_date
 * @copyright 2018 David Matamoros <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_controller extends \core_customfield\field_controller {
    /**
     * Type of plugin data
     */
    const TYPE = 'date';

    /**
     * Validate the data from the config form.
     *
     * @param array $data
     * @param array $files
     * @return array associative array of error messages
     */
    public function config_form_validation(array $data, $files = array()) : array {
        $errors = array();

        // Make sure the start year is not greater than the end year.
        if (!empty($data['configdata']['mindate']) && !empty($data['configdata']['maxdate']) &&
                $data['configdata']['mindate'] > $data['configdata']['maxdate']) {
            $errors['configdata[mindate]'] = get_string('mindateaftermax', 'customfield_date');
        }

        return $errors;
    }

    /**
     * Add fields for editing a date field.
     *
     * @param \MoodleQuickForm $mform
     */
    public function config_form_definition(\MoodleQuickForm $mform) {
        $config = $this->get('configdata');

        // Add elements.
        $mform->addElement('header', 'header_specificsettings', get_string('specificsettings', 'customfield_date'));
        $mform->setExpanded('header_specificsettings', true);

        $mform->addElement('advcheckbox', 'configdata[includetime]', get_string('includetime', 'customfield_date'));

        $mform->addElement('date_time_selector', 'configdata[mindate]', get_string('mindate', 'customfield_date'),
            ['optional' => true]);

        $mform->addElement('date_time_selector', 'configdata[maxdate]', get_string('maxdate', 'customfield_date'),
            ['optional' => true]);

        $mform->hideIf('configdata[maxdate][hour]', 'configdata[includetime]');
        $mform->hideIf('configdata[maxdate][minute]', 'configdata[includetime]');
        $mform->hideIf('configdata[mindate][hour]', 'configdata[includetime]');
        $mform->hideIf('configdata[mindate][minute]', 'configdata[includetime]');
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
        $format = get_string('strftimedate', 'langconfig');
        $ret = [];
        foreach ($values as $value) {
            if ($value) {
                $ret[$value] = userdate($value, $format);
            }
        }
        if (!$ret) {
            return []; // If the only dates found are 0, then do not show any options.
        }
        $ret[BLOCK_MYOVERVIEW_CUSTOMFIELD_EMPTY] = get_string('nocustomvalue', 'block_myoverview',
            $this->get_formatted_name());
        return $ret;
    }
}