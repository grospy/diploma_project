<?php
//

/**
 * Event observer.
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_recentlyaccesseditems;

defined('MOODLE_INTERNAL') || die();

/**
 * Events observer.
 *
 * Stores all actions about modules viewed in block_recentlyaccesseditems table.
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {

    /**
     * @var string Block table name.
     */
    private static $table = 'block_recentlyaccesseditems';

    /**
     * Register items views in block_recentlyaccesseditems table.
     *
     * When the item is view for the first time, a new record is created. If the item was viewed before, the time is
     * updated.
     *
     * @param \core\event\base $event
     */
    public static function store(\core\event\base $event) {
        global $DB;

        if (!isloggedin() or \core\session\manager::is_loggedinas() or isguestuser()) {
            // No access tracking.
            return;
        }

        $conditions = [
            'userid' => $event->userid
        ];

        $records = $DB->get_records(self::$table, $conditions, "timeaccess DESC");

        foreach ($records as $record) {
            if (($record->userid == $event->userid) && ($record->cmid == $event->contextinstanceid)) {
                $conditions = [
                        'userid' => $event->userid,
                        'cmid' => $event->contextinstanceid
                ];
                $DB->set_field(self::$table, 'timeaccess', $event->timecreated, $conditions);
                return;
            }
        }

        if (count($records) >= 9) {
            $conditions = [
                    'id' => end($records)->id,
            ];
            $DB->delete_records(self::$table, $conditions);
        }

        $eventdata = new \stdClass();

        $eventdata->cmid = $event->contextinstanceid;
        $eventdata->timeaccess = $event->timecreated;
        $eventdata->courseid = $event->courseid;
        $eventdata->userid = $event->userid;

        $DB->insert_record(self::$table, $eventdata);
    }

    /**
     * Remove record when course module is deleted.
     *
     * @param \core\event\base $event
     */
    public static function remove(\core\event\base $event) {
        global $DB;

        $DB->delete_records(self::$table, array('cmid' => $event->contextinstanceid));
    }
}