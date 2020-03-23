<?php
//

/**
 * Contains functions called by core.
 *
 * @package    block_online_users
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Callback to define user preferences.
 *
 * @return array
 */
function block_online_users_user_preferences() {
    $preferences = array();
    $preferences['block_online_users_uservisibility'] = array(
        'type' => PARAM_INT,
        'null' => NULL_NOT_ALLOWED,
        'default' => 1,
        'choices' => array(0, 1),
        'permissioncallback' => function($user, $preferencename) {
            global $USER;
            return $user->id == $USER->id;
        }
    );

    return $preferences;
}
