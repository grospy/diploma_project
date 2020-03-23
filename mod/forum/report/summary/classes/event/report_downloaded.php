<?php
//

/**
 * The forum summary report downloaded event.
 *
 * @package forumreport_summary
 * @copyright  2019 Michael Hawkins <michaelh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace forumreport_summary\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The forum summary report downloaded event class.
 *
 * @package    forumreport_summary
 * @since      Moodle 3.8
 * @copyright  2019 Michael Hawkins <michaelh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_downloaded extends \core\event\base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventreportdownloaded', 'forumreport_summary');
    }

    /**
     * Returns non-localised event description with ids for admin use only.
     *
     * @return string
     */
    public function get_description() {
        if ($this->other['hasviewall']) {
            return "The user with id '{$this->userid}' downloaded the summary report for the forum with " .
                    "course module id '{$this->contextinstanceid}'.";
        } else {
            return "The user with id '{$this->userid}' downloaded their own summary report for the forum with " .
                    "course module id '{$this->contextinstanceid}'.";
        }
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/forum/report/summary/index.php',
                ['courseid' => $this->courseid, 'forumid' => $this->other['forumid']]);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['hasviewall'])) {
            throw new \coding_exception('The \'hasviewall\' value must be set');
        }
    }
}
