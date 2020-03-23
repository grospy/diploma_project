<?php
//

/**
 * This file contains the core_privacy\local\request helper.
 *
 * @package core_privacy
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * A class containing a set of data transformations for core data types.
 *
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class transform {
    /**
     * Translate a userid into the standard user format for exports.
     *
     * We have not determined if we will do this or not, but we provide the functionality and encourgae people to use
     * it so that it can be retrospectively fitted if required.
     *
     * @param   int         $userid the userid to translate
     * @return  mixed
     */
    public static function user(int $userid) {
        // For the moment we do not think we should transform as this reveals information about other users.
        // However this function is implemented should the need arise in the future.
        return $userid;
    }

    /**
     * Translate a unix timestamp into a datetime string.
     *
     * @param   int         $datetime the unixtimestamp to translate.
     * @return  string      The translated string.
     */
    public static function datetime($datetime) {
        return userdate($datetime, get_string('strftimedaydatetime', 'langconfig'));
    }

    /**
     * Translate a unix timestamp into a date string.
     *
     * @param   int         $date the unixtimestamp to translate.
     * @return  string      The translated string.
     */
    public static function date($date) {
        return userdate($date, get_string('strftimedate', 'langconfig'));
    }

    /**
     * Translate a bool or int (0/1) value into a translated yes/no string.
     *
     * @param   bool        $value The value to translate
     * @return  string
     */
    public static function yesno($value) {
        if ($value) {
            return get_string('yes');
        } else {
            return get_string('no');
        }
    }
}
