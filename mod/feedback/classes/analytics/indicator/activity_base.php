<?php
//

/**
 * Activity base class.
 *
 * @package   mod_feedback
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_feedback\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_feedback
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class activity_base extends \core_analytics\local\indicator\community_of_inquiry_activity {

    /**
     * Overwritten to mark as viewed if stats are published.
     *
     * @param \cm_info $cm
     * @param int $contextid
     * @param int $userid
     * @param int $after
     * @return bool
     */
    protected function feedback_viewed(\cm_info $cm, $contextid, $userid, $after = null) {
        // If stats are published any write action counts as viewed feedback.
        if (!empty($this->instancedata[$cm->instance]->publish_stats)) {
            $user = (object)['id' => $userid];
            return $this->any_write_log($contextid, $user);
        }

        return parent::feedback_viewed($cm, $contextid, $userid, $after);
    }

    /**
     * Returns the name of the field that controls activity availability.
     *
     * @return null|string
     */
    protected function get_timeclose_field() {
        return 'timeclose';
    }
}
