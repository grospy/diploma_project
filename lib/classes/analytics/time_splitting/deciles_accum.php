<?php
//

/**
 * Range processor splitting the course in ten parts and accumulating data.
 *
 * @package   core
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Range processor splitting the course in ten parts and accumulating data.
 *
 * @package   core
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class deciles_accum extends \core_analytics\local\time_splitting\accumulative_parts {

    /**
     * Returns a lang_string object representing the name for the time splitting method.
     *
     * Used as column identificator.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('timesplitting:decilesaccum');
    }

    /**
     * 10 parts.
     *
     * @return int
     */
    protected function get_number_parts() {
        return 10;
    }
}
