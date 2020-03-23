<?php
//

/**
 * Cognitive depth indicator - forum.
 *
 * @package   mod_forum
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Cognitive depth indicator - forum.
 *
 * @package   mod_forum
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
        return new \lang_string('indicator:cognitivedepth', 'mod_forum');
    }

    public function get_indicator_type() {
        return self::INDICATOR_COGNITIVE;
    }

    public function get_cognitive_depth_level(\cm_info $cm) {
        return self::COGNITIVE_LEVEL_4;
    }

    /**
     * feedback_check_grades
     *
     * @return bool
     */
    protected function feedback_check_grades() {
        return false;
    }

    /**
     * feedback_replied_events
     *
     * @return string[]
     */
    protected function feedback_replied_events() {
        return array('\mod_forum\event\assessable_uploaded');
    }

}
