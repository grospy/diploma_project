<?php
//

/**
 * Defines message providers (types of messages being sent)
 *
 * @package   tool_dataprivacy
 * @copyright 2018 onwards  Jun Pataleta
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$messageproviders = [
    // Notify Data Protection Officer about incoming data requests.
    'contactdataprotectionofficer' => [
        'defaults' => [
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ],
        'capability'  => 'tool/dataprivacy:managedatarequests'
    ],

    // Notify user about the processing results of their data request.
    'datarequestprocessingresults' => [
        'defaults' => [
            'popup' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ]
    ],

    // Notify Data Protection Officer about exceptions.
    'notifyexceptions' => [
        'defaults' => [
            'email' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ],
        'capability'  => 'tool/dataprivacy:managedatarequests'
    ],
];
