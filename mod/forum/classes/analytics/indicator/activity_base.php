<?php
//

/**
 * Activity base class.
 *
 * @package   mod_forum
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_forum
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class activity_base extends \core_analytics\local\indicator\community_of_inquiry_activity {

    /**
     * feedback_viewed_events
     *
     * @return string[]
     */
    protected function feedback_viewed_events() {
        // We could add any forum event, but it will make feedback_post_action slower.
        return array('\mod_forum\event\assessable_uploaded', '\mod_forum\event\course_module_viewed',
            '\mod_forum\event\discussion_viewed');
    }

    /**
     * feedback_post_action
     *
     * @param \cm_info $cm
     * @param int $contextid
     * @param int $userid
     * @param string[] $eventnames
     * @param int $after
     * @return bool
     */
    protected function feedback_post_action(\cm_info $cm, $contextid, $userid, $eventnames, $after = false) {

        if (empty($this->activitylogs[$contextid][$userid])) {
            return false;
        }

        $logs = $this->activitylogs[$contextid][$userid];

        if (empty($logs['\mod_forum\event\assessable_uploaded'])) {
            // No feedback viewed if there is no submission.
            return false;
        }

        // First user post time.
        $firstpost = $logs['\mod_forum\event\assessable_uploaded']->timecreated[0];

        // We consider feedback any other user post in any of this forum discussions.
        foreach ($this->activitylogs[$contextid] as $anotheruserid => $logs) {
            if ($anotheruserid == $userid) {
                continue;
            }
            if (empty($logs['\mod_forum\event\assessable_uploaded'])) {
                continue;
            }
            $firstpostsenttime = $logs['\mod_forum\event\assessable_uploaded']->timecreated[0];

            if (parent::feedback_post_action($cm, $contextid, $userid, $eventnames, $firstpostsenttime)) {
                return true;
            }
            // Continue with the next user.
        }

        return false;
    }
}
