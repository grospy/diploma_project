<?php
//

/**
 * Cognitive depth indicator - assign.
 *
 * @package   mod_assign
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_assign\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Cognitive depth indicator - assign.
 *
 * @package   mod_assign
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
        return new \lang_string('indicator:cognitivedepth', 'mod_assign');
    }

    public function get_indicator_type() {
        return self::INDICATOR_COGNITIVE;
    }

    public function get_cognitive_depth_level(\cm_info $cm) {
        return self::COGNITIVE_LEVEL_5;
    }

    /**
     * feedback_submitted_events
     *
     * @return string[]
     */
    protected function feedback_submitted_events() {
        return array('\mod_assign\event\assessable_submitted');
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
