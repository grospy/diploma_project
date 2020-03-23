<?php
//

/**
 * Privacy Subsystem implementation for block_starredcourses.
 *
 * @package    block_starredcourses
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_starredcourses\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for block_starredcourses.
 *
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
