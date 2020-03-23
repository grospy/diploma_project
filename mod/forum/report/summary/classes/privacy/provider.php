<?php
//

/**
 * Privacy Subsystem implementation for forumreport_summary subplugin.
 *
 * @package    forumreport_summary
 * @copyright  2019 Michael Hawkins <michaelh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace forumreport_summary\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem implementation for forumreport_summary subplugin, implementing null_provider.
 *
 * @copyright  2019 Michael Hawkins <michaelh@moodle.com>
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
