<?php
//

/**
 * This file contains the \core_privacy\local\request\user_preference_provider interface to describe
 * a class which provides preference data in some form to core.
 *
 * @package core_privacy
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * The user_preference_provider interface is an interface designed to be
 * implemented by components directly to describe a case where that
 * component is responsible for storing some form of system-wide user
 * preference.
 *
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface user_preference_provider extends core_data_provider {

    /**
     * Export all user preferences for the plugin.
     *
     * @param   int         $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid);
}
