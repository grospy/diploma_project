<?php
//

/**
 * Single time splitting method.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Single time splitting method.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class single_range extends \core_analytics\local\time_splitting\base
        implements \core_analytics\local\time_splitting\before_now {

    /**
     * Returns a lang_string object representing the name for the time spliting method.
     *
     * Used as column identificator.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('timesplitting:singlerange');
    }

    /**
     * One single range covering all analysable duration.
     *
     * @return array
     */
    protected function define_ranges() {
        // Key 'time' == 0 because we want it to start predicting from the beginning.
        return [
            [
                'start' => $this->analysable->get_start(),
                'end' => $this->analysable->get_end(),
                'time' => 0
            ]
        ];
    }
}
