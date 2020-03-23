<?php
//

/**
 * Cognitive depth indicator - choice.
 *
 * @package   mod_choice
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_choice\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Cognitive depth indicator - choice.
 *
 * @package   mod_choice
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
        return new \lang_string('indicator:cognitivedepth', 'mod_choice');
    }

    public function get_indicator_type() {
        return self::INDICATOR_COGNITIVE;
    }

    public function get_cognitive_depth_level(\cm_info $cm) {
        $this->fill_instance_data($cm);

        if ($this->instancedata[$cm->instance]->showresults == 0 || $this->instancedata[$cm->instance]->showresults == 4) {
            // Results are not shown to students or are always shown.
            return self::COGNITIVE_LEVEL_2;
        }

        return self::COGNITIVE_LEVEL_3;
    }
}
