<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * External functions and service definitions.
 *
 * @package    message_popup
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$functions = array(
    'message_popup_get_popup_notifications' => array(
        'classname' => 'message_popup_external',
        'methodname' => 'get_popup_notifications',
        'classpath' => 'message/output/popup/externallib.php',
        'description' => 'Retrieve a list of popup notifications for a user',
        'type' => 'read',
        'ajax' => true,
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'message_popup_get_unread_popup_notification_count' => array(
        'classname' => 'message_popup_external',
        'methodname' => 'get_unread_popup_notification_count',
        'classpath' => 'message/output/popup/externallib.php',
        'description' => 'Retrieve the count of unread popup notifications for a given user',
        'type' => 'read',
        'ajax' => true,
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
