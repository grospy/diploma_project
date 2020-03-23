<?php
//

/**
 * Fixtures for database log storage testing.
 *
 * @package    logstore_database
 * @copyright  2014 onwards Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_database\test;

defined('MOODLE_INTERNAL') || die();

class store extends \logstore_database\log\store {
    /**
     * Public wrapper for testing.
     *
     * @param \core\event\base $event
     *
     * @return bool
     */
    public function is_event_ignored(\core\event\base $event) {
        return parent::is_event_ignored($event);
    }
}