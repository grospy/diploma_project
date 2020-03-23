<?php
//

/**
 * Privacy provider implementation for fileconverter_unoconv.
 *
 * @package    fileconverter_unoconv
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace fileconverter_unoconv\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy provider implementation for fileconverter_unoconv.
 *
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
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
