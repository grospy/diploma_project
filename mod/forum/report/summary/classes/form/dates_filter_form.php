<?php
//

/**
 * The mform used by the forum summary report dates filter.
 *
 * @package forumreport_summary
 * @copyright 2019 Michael Hawkins <michaelh@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace forumreport_summary\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * The mform class for creating the forum summary report dates filter.
 *
 * @copyright 2019 Michael Hawkins <michaelh@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class dates_filter_form extends \moodleform {
    /**
     * The form definition.
     *
     */
    public function definition() {
        $attributes = [
            'class' => 'align-items-center',
        ];

        // From date field.
        $this->_form->addElement('date_selector', 'filterdatefrompopover', get_string('from'), ['optional' => true], $attributes);

        // To date field.
        $this->_form->addElement('date_selector', 'filterdatetopopover', get_string('to'), ['optional' => true], $attributes);
    }
}
