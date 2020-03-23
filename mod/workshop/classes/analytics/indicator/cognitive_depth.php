<?php
//

/**
 * Cognitive depth indicator - workshop.
 *
 * @package   mod_workshop
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Cognitive depth indicator - workshop.
 *
 * @package   mod_workshop
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
        return new \lang_string('indicator:cognitivedepth', 'mod_workshop');
    }

    public function get_indicator_type() {
        return self::INDICATOR_COGNITIVE;
    }

    public function get_cognitive_depth_level(\cm_info $cm) {
        return self::COGNITIVE_LEVEL_5;
    }

    /**
     * feedback_replied_events
     *
     * @return string[]
     */
    protected function feedback_replied_events() {
        return array('\mod_workshop\event\submission_assessed', '\mod_workshop\event\submission_reassessed');
    }

    /**
     * feedback_submitted_events
     *
     * @return string[]
     */
    protected function feedback_submitted_events() {
        // Can't use assessable_uploaded instead of submission_* as mod_workshop only triggers it during submission_updated.
        return array('\mod_workshop\event\submission_updated', '\mod_workshop\event\submission_created',
            '\mod_workshop\event\submission_reassessed');
    }
}
