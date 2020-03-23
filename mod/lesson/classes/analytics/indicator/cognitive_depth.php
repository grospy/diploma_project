<?php
//

/**
 * Cognitive depth indicator - lesson.
 *
 * @package   mod_lesson
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lesson\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Cognitive depth indicator - lesson.
 *
 * @package   mod_lesson
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cognitive_depth extends activity_base {

    /**
     * Returns the name.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('indicator:cognitivedepth', 'mod_lesson');
    }

    public function get_indicator_type() {
        return self::INDICATOR_COGNITIVE;
    }

    public function get_cognitive_depth_level(\cm_info $cm) {
        return self::COGNITIVE_LEVEL_5;
    }

    /**
     * feedback_submitted
     *
     * @param \cm_info $cm
     * @param int $contextid
     * @param int $userid
     * @param int $after
     * @return bool
     */
    protected function feedback_submitted(\cm_info $cm, $contextid, $userid, $after = false) {
        if (empty($this->activitylogs[$contextid][$userid]) ||
                empty($this->activitylogs[$contextid][$userid]['\mod_lesson\event\lesson_ended'])) {
            return false;
        }

        // Multiple lesson attempts completed counts as submitted after feedback.
        return (2 >= count($this->activitylogs[$contextid][$userid]['\mod_lesson\event\lesson_ended']->timecreated));
    }

    /**
     * feedback_replied
     *
     * @param \cm_info $cm
     * @param int $contextid
     * @param int $userid
     * @param int $after
     * @return bool
     */
    protected function feedback_replied(\cm_info $cm, $contextid, $userid, $after = false) {
        // No level 4.
        return false;
    }

}
