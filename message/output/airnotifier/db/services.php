<?php
//


/**
 * Airnotifier external functions and service definitions.
 *
 * @package    message_airnotifier
 * @category   webservice
 * @copyright  2012 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(
    'message_airnotifier_is_system_configured' => array(
        'classname'   => 'message_airnotifier_external',
        'methodname'  => 'is_system_configured',
        'classpath'   => 'message/output/airnotifier/externallib.php',
        'description' => 'Check whether the airnotifier settings have been configured',
        'type'        => 'read',
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),

    'message_airnotifier_are_notification_preferences_configured' => array(
        'classname'   => 'message_airnotifier_external',
        'methodname'  => 'are_notification_preferences_configured',
        'classpath'   => 'message/output/airnotifier/externallib.php',
        'description' => 'Check if the users have notification preferences configured yet',
        'type'        => 'read',
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'message_airnotifier_get_user_devices' => array(
        'classname'   => 'message_airnotifier_external',
        'methodname'  => 'get_user_devices',
        'classpath'   => 'message/output/airnotifier/externallib.php',
        'description' => 'Return the list of mobile devices that are registered in Moodle for the given user',
        'type'        => 'read',
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'message_airnotifier_enable_device' => array(
        'classname'    => 'message_airnotifier_external',
        'methodname'   => 'enable_device',
        'classpath'    => 'message/output/airnotifier/externallib.php',
        'description'  => 'Enables or disables a registered user device so it can receive Push notifications',
        'type'         => 'write',
        'capabilities' => 'message/airnotifier:managedevice',
        'services'     => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
