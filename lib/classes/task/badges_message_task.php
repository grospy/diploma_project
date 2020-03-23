<?php
//

/**
 * A scheduled task.
 *
 * @package    core
 * @copyright  2019 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

/**
 * Simple task to run the badges cron.
 */
class badges_message_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskbadgesmessagecron', 'admin');
    }

    /**
     * Reviews criteria and awards badges
     *
     * First find all badges that can be earned, then reviews each badge.
     */
    public function execute() {
        global $CFG, $DB;

        if (!empty($CFG->enablebadges)) {
            require_once($CFG->libdir . '/badgeslib.php');
            mtrace('Sending scheduled badge notifications.');

            $scheduled = $DB->get_records_select('badge', 'notification > ? AND (status != ?) AND nextcron < ?',
                array(BADGE_MESSAGE_ALWAYS, BADGE_STATUS_ARCHIVED, time()),
                'notification ASC', 'id, name, notification, usercreated as creator, timecreated');

            foreach ($scheduled as $sch) {
                // Send messages.
                badge_assemble_notification($sch);

                // Update next cron value.
                $nextcron = badges_calculate_message_schedule($sch->notification);
                $DB->set_field('badge', 'nextcron', $nextcron, array('id' => $sch->id));
            }
        }
    }

}
