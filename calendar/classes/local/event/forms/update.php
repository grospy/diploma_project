<?php
//

/**
 * The mform for updating a calendar event. Based on the old event form.
 *
 * @package    core_calendar
 * @copyright 2017 Ryan Wyllie <ryan@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_calendar\local\event\forms;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * The mform class for updating a calendar event.
 *
 * @copyright 2017 Ryan Wyllie <ryan@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class update extends create {
    /**
     * Add the repeat elements for the form when editing an existing event.
     *
     * @param MoodleQuickForm $mform
     */
    protected function add_event_repeat_elements($mform) {
        $event = $this->_customdata['event'];

        $mform->addElement('hidden', 'repeatid');
        $mform->setType('repeatid', PARAM_INT);

        if (!empty($event->repeatid)) {
            $group = [];
            $group[] = $mform->createElement('radio', 'repeateditall', null, get_string('repeateditall', 'calendar',
                    $event->eventrepeats), 1);
            $group[] = $mform->createElement('radio', 'repeateditall', null, get_string('repeateditthis', 'calendar'), 0);
            $mform->addGroup($group, 'repeatgroup', get_string('repeatedevents', 'calendar'), '<br />', false);

            $mform->setDefault('repeateditall', 1);
            $mform->setAdvanced('repeatgroup');
        }
    }
}
