<?php
//

/**
 * Privacy Subsystem implementation for gradeexport_txt.
 *
 * @package    gradeexport_txt
 * @copyright  2018 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradeexport_txt\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for gradeexport_txt implementing null_provider.
 *
 * @copyright  2018 Sara Arjona <sara@moodle.com>
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
