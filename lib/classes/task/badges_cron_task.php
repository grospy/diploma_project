<?php
//

/**
 * A scheduled task.
 *
 * @package    core
 * @copyright  2013 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

/**
 * Simple task to run the badges cron.
 */
class badges_cron_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskbadgescron', 'admin');
    }

    /**
     * Reviews criteria and awards badges
     *
     * First find all badges that can be earned, then reviews each badge.
     * (Not sure how efficient this is timewise).
     */
    public function execute() {
        global $DB, $CFG;
        if (!empty($CFG->enablebadges)) {
            require_once($CFG->libdir . '/badgeslib.php');
            $total = 0;

            $courseparams = array();
            if (empty($CFG->badges_allowcoursebadges)) {
                $coursesql = '';
            } else {
                $coursesql = ' OR EXISTS (SELECT c.id FROM {course} c WHERE c.visible = :visible AND c.startdate < :current'
                        . '     AND c.id = b.courseid) ';
                $courseparams = array('visible' => true, 'current' => time());
            }

            $sql = 'SELECT b.id
                      FROM {badge} b
                     WHERE (b.status = :active OR b.status = :activelocked)
                       AND (b.type = :site ' . $coursesql . ')';
            $badgeparams = [
                'active' => BADGE_STATUS_ACTIVE,
                'activelocked' => BADGE_STATUS_ACTIVE_LOCKED,
                'site' => BADGE_TYPE_SITE
            ];
            $params = array_merge($badgeparams, $courseparams);
            $badges = $DB->get_fieldset_sql($sql, $params);

            mtrace('Started reviewing available badges.');
            foreach ($badges as $bid) {
                $badge = new \badge($bid);

                if ($badge->has_criteria()) {
                    if (debugging()) {
                        mtrace('Processing badge "' . $badge->name . '"...');
                    }

                    $issued = $badge->review_all_criteria();

                    if (debugging()) {
                        mtrace('...badge was issued to ' . $issued . ' users.');
                    }
                    $total += $issued;
                }
            }

            mtrace('Badges were issued ' . $total . ' time(s).');
        }
    }
}
