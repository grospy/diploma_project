<?php
//

/**
 * File containing the field_value_validators class.
 *
 * @package    tool_uploaduser
 * @copyright  2019 Mathew May
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_uploaduser\local;

defined('MOODLE_INTERNAL') || die();

/**
 * Field validator class.
 *
 * @package    tool_uploaduser
 * @copyright  2019 Mathew May
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_value_validators {

    /**
     * List of valid and compatible themes.
     *
     * @return array
     */
    protected static $themescache;

    /**
     * Validates the value provided for the theme field.
     *
     * @param string $value The value for the theme field.
     * @return array Contains the validation status and message.
     */
    public static function validate_theme($value) {
        global $CFG;

        $status = 'normal';
        $message = '';

        // Validate if user themes are allowed.
        if (!$CFG->allowuserthemes) {
            $status = 'warning';
            $message = get_string('userthemesnotallowed', 'tool_uploaduser');
        } else {
            // Cache list of themes if not yet set.
            if (!isset(self::$themescache)) {
                self::$themescache = get_list_of_themes();
            }

            // Check if we have a valid theme.
            if (empty($value)) {
                $status = 'warning';
                $message = get_string('notheme', 'tool_uploaduser');
            } else if (!isset(self::$themescache[$value])) {
                $status = 'warning';
                $message = get_string('invalidtheme', 'tool_uploaduser', s($value));
            }
        }

        return [$status, $message];
    }
}
