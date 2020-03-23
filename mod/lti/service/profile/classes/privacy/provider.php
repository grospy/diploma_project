<?php
//

/**
 * Privacy Subsystem implementation for ltiservice_profile.
 *
 * @package    ltiservice_profile
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace ltiservice_profile\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for ltiservice_profile implementing null_provider.
 *
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
