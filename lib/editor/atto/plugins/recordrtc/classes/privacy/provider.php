<?php
//

/**
 * Privacy Subsystem implementation for atto_recordrtc.
 *
 * @package    atto_recordrtc
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace atto_recordrtc\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for atto_recordrtc implementing null_provider.
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
