<?php
//

/**
 * Defines message providers (types of messages being sent)
 *
 * The providers defined on this file are processed and registered into
 * the Moodle DB after any install or upgrade operation. All plugins
 * support this.
 *
 * For more information, take a look to the documentation available:
 *     - Message API: {@link http://docs.moodle.org/dev/Message_API}
 *     - Upgrade API: {@link http://docs.moodle.org/dev/Upgrade_API}
 *
 * @package   core
 * @category  message
 * @copyright 2008 onwards Martin Dougiamas  http://dougiamas.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$messageproviders = array (

    // Notices that an admin might be interested in
    'notices' => array (
         'capability'  => 'moodle/site:config'
    ),

    // Important errors that an admin ought to know about
    'errors' => array (
         'capability'  => 'moodle/site:config'
    ),

    // cron-based notifications about available moodle and/or additional plugin updates
    'availableupdate' => array(
        'capability' => 'moodle/site:config',
        'defaults' => array(
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF
        ),

    ),

    'instantmessage' => array (
        'defaults' => array(
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ),

    'backup' => array (
        'capability'  => 'moodle/site:config'
    ),

    // Course creation request notification
    'courserequested' => array (
        'capability'  => 'moodle/site:approvecourse'
    ),

    // Course request approval notification
    'courserequestapproved' => array (
         'capability'  => 'moodle/course:request',
         'defaults' => array(
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ),

    // Course request rejection notification
    'courserequestrejected' => array (
        'capability'  => 'moodle/course:request',
        'defaults' => array(
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ),

    // Badge award notification to a badge recipient.
    'badgerecipientnotice' => array (
        'defaults' => array(
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
        'capability'  => 'moodle/badges:earnbadge'
    ),

    // Badge award notification to a badge creator (mostly cron-based).
    'badgecreatornotice' => array (
        'defaults' => array(
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
        )
    ),

    // A comment was left on a plan.
    'competencyplancomment' => array(),

    // A comment was left on a user competency.
    'competencyusercompcomment' => array(),

    // User insights.
    'insights' => array (
        'defaults' => [
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ]
    ),

    // Message contact requests.
    'messagecontactrequests' => [
        'defaults' => [
            // We don't need to notify in the popup output here because the message drawer
            // already notifies users of contact requests.
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ]
    ],

    // Asyncronhous backup/restore notifications.
    'asyncbackupnotification' => array(
        'defaults' => array(
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
        )
    ),

    'gradenotifications' => [
        'defaults' => array(
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ],
);
