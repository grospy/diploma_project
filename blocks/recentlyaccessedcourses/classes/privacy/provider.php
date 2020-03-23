<?php
//

/**
 * Privacy Subsystem implementation for Recently accessed courses block.
 *
 * @package    block_recentlyaccessedcourses
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_recentlyaccessedcourses\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for Recently accessed courses block.
 *
 * @copyright  2018 Victor Deniz <victor@moodle.com>
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
