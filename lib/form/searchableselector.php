<?php
//


/**
 * Searchable selector field (alias for autocomplete).
 *
 * Allows auto-complete selector.
 *
 * @package   core_form
 * @copyright 2015 Damyon Wiese <damyon@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

global $CFG;
require_once($CFG->libdir . '/form/autocomplete.php');

/**
 * Form field type for selecting from a list of options.
 *
 * Allows auto-complete ajax searching.
 *
 * @package   core_form
 * @copyright 2015 Damyon Wiese <damyon@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class MoodleQuickForm_searchableselector extends MoodleQuickForm_autocomplete {

    /**
     * Constructor
     *
     * @param string $elementname Element name
     * @param mixed $elementlabel Label(s) for an element
     * @param array $options List of valid options for the select
     * @param array $attributes List of HTML attributes for the select
     */
    public function __construct($elementname = null, $elementlabel = null, $options = [], $attributes = []) {
        unset($options['']);
        $options = ['' => get_string('noselection', 'form')] + $options;
        parent::__construct($elementname, $elementlabel, $options, $attributes);
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function MoodleQuickForm_searchableselector($elementName=null, $elementLabel=null, $options=null, $attributes=null) {
        debugging('Use of class name as constructor is deprecated', DEBUG_DEVELOPER);
        self::__construct($elementName, $elementLabel, $options, $attributes);
    }
}
