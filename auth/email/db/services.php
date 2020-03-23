<?php
//

/**
 * Auth email webservice definitions.
 *
 * @package    auth_email
 * @copyright  2016 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(

    'auth_email_get_signup_settings' => array(
        'classname'   => 'auth_email_external',
        'methodname'  => 'get_signup_settings',
        'description' => 'Get the signup required settings and profile fields.',
        'type'        => 'read',
        'ajax'          => true,
        'loginrequired' => false,
    ),
    'auth_email_signup_user' => array(
        'classname'   => 'auth_email_external',
        'methodname'  => 'signup_user',
        'description' => 'Adds a new user (pendingto be confirmed) in the site.',
        'type'        => 'write',
        'ajax'          => true,
        'loginrequired' => false,
    ),
);

