<?php
//

/**
 * Privacy Subsystem implementation for mlbackend_python.
 *
 * @package    mlbackend_python
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mlbackend_python\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for mlbackend_python implementing null_provider.
 *
 * @copyright  2018 David Monllao
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
