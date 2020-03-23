<?php
//

/**
 * This file definies observers needed by the plugin.
 *
 * @package    auth_oauth2
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// List of observers.
$observers = [
    [
        'eventname'   => '\core\event\user_deleted',
        'callback'    => '\auth_oauth2\api::user_deleted',
    ],
];
