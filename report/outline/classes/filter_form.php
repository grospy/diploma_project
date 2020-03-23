<?php
//

/**
 * Form to filter the outline report
 *
 * @package   report_outline
 * @copyright 2017 Davo Smith, Synergy Learning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace report_outline;

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once($CFG->libdir.'/formslib.php');

/**
 * Class filter_form form to filter the results by date
 * @package report_outline
 */
class filter_form extends \moodleform {
    /**
     * Form definition
     * @throws \HTML_QuickForm_Error
     * @throws \coding_exception
     */
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('header', 'filterheader', get_string('filter'));
        $opts = ['optional' => true];
        $mform->addElement('date_selector', 'filterstartdate', get_string('from'), $opts);
        $mform->addElement('date_selector', 'filterenddate', get_string('to'), $opts);

        $mform->setExpanded('filterheader', false);

        // Add the filter/cancel buttons (without 'closeHeaderBefore', so they collapse with the filter).
        $buttonarray = [
            $mform->createElement('submit', 'submitbutton', get_string('filter')),
            $mform->createElement('cancel'),
        ];
        $mform->addGroup($buttonarray, 'buttonar', '', [' '], false);
    }

    /**
     * Expand the form contents if the filter is in use.
     * @throws \HTML_QuickForm_Error
     */
    public function definition_after_data() {
        $mform = $this->_form;
        $filterstartdate = $mform->getElement('filterstartdate')->getValue();
        $filterenddate = $mform->getElement('filterenddate')->getValue();
        if (!empty($filterstartdate['enabled']) || !empty($filterenddate['enabled'])) {
            $mform->setExpanded('filterheader', true);
        }
    }
}
