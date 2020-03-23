<?php
//

/**
 * Activity base class.
 *
 * @package   mod_choice
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_choice\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_choice
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
        return array('\mod_choice\event\course_module_viewed', '\mod_choice\event\answer_updated');
    }

    /**
     * feedback_viewed
     *
     * @param \cm_info $cm
     * @param int $contextid
     * @param int $userid
     * @param int $after
     * @return bool
     */
    protected function feedback_viewed(\cm_info $cm, $contextid, $userid, $after = null) {

        // If results are shown after they answer a write action counts as feedback viewed.
        if ($this->instancedata[$cm->instance]->showresults == 1) {
            // The user id will be enough for any_write_log.
            $user = (object)['id' => $userid];
            return $this->any_write_log($contextid, $user);
        }

        $after = null;
        if ($this->instancedata[$cm->instance]->timeclose) {
            $after = $this->instancedata[$cm->instance]->timeclose;
        }

        return $this->feedback_post_action($cm, $contextid, $userid, $this->feedback_viewed_events(), $after);
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
