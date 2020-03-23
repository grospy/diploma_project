<?php
//

/**
 * A schedule task for scheduled allocation cron.
 *
 * @package   workshopallocation_scheduled
 * @copyright 2019 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace workshopallocation_scheduled\task;

defined('MOODLE_INTERNAL') || die();

/**
 * The main schedule task for scheduled allocation cron.
 *
 * @package   workshopallocation_scheduled
 * @copyright 2019 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cron_task extends \core\task\scheduled_task {
    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('crontask', 'workshopallocation_scheduled');
    }

    /**
     * Run scheduled allocation cron.
     */
    public function execute() {
        global $CFG, $DB;

        $sql = "SELECT w.*
                  FROM {workshopallocation_scheduled} a
                  JOIN {workshop} w ON a.workshopid = w.id
                 WHERE a.enabled = 1
                   AND w.phase = 20
                   AND w.submissionend > 0
                   AND w.submissionend < ?
                   AND (a.timeallocated IS NULL OR a.timeallocated < w.submissionend)";
        $workshops = $DB->get_records_sql($sql, array(time()));

        if (empty($workshops)) {
            mtrace('... no workshops awaiting scheduled allocation. ', '');
            return;
        }

        mtrace('... executing scheduled allocation in ' . count($workshops) . ' workshop(s) ... ', '');

        require_once($CFG->dirroot . '/mod/workshop/locallib.php');

        foreach ($workshops as $workshop) {
            $cm = get_coursemodule_from_instance('workshop', $workshop->id, $workshop->course, false, MUST_EXIST);
            $course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
            $workshop = new \workshop($workshop, $cm, $course);
            $allocator = $workshop->allocator_instance('scheduled');
            $allocator->execute();
        }
    }
}
