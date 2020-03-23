<?php
//

/**
 * Privacy class for requesting user data.
 *
 * @package    assignfeedback_offline
 * @copyright  2018 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace assignfeedback_offline\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy class for requesting user data.
 *
 * @package    assignfeedback_offline
 * @copyright  2018 Adrian Greeve <adrian@moodle.com>
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
        return 'privacy:nullproviderreason';
    }
}
