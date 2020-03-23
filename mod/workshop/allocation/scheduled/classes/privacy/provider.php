<?php
//

/**
 * Provides the class {@link workshopallocation_scheduled\privacy\provider}
 *
 * @package     workshopallocation_scheduled
 * @category    privacy
 * @copyright   2018 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace workshopallocation_scheduled\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy API implementation for the Scheduled allocation method.
 *
 * @copyright 2018 David Mudrák <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Explain that this plugin stores no personal data.
     *
     * @return string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
