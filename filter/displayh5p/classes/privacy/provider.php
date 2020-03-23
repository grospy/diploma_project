<?php
//

/**
 * Privacy Subsystem implementation for filter_displayh5p.
 *
 * @package    filter_displayh5p
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_displayh5p\privacy;

defined('MOODLE_INTERNAL') || die;

/**
 * Privacy Subsystem for filter_displayh5p implementing null_provider.
 *
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
