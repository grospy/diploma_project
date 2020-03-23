<?php
//

/**
 * Activity base class.
 *
 * @package   mod_data
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_data\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_data
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class activity_base extends \core_analytics\local\indicator\community_of_inquiry_activity {

    /**
     * Returns the name of the field that controls activity availability.
     *
     * @return null|string
     */
    protected function get_timeclose_field() {
        return 'timeavailableto';
    }
}
