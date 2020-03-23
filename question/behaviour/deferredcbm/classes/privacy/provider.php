<?php
//

/**
 * Privacy Subsystem implementation for qbehaviour_deferredcbm.
 *
 * @package    qbehaviour_deferredcbm
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qbehaviour_deferredcbm\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for qbehaviour_deferredcbm implementing null_provider.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
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
