<?php
//

/**
 * Capability definitions for this module.
 *
 * @package   tool_dataprivacy
 * @copyright 2018 onwards Jun Pataleta
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = [

    // Capability for managing data requests. Usually given to the site's Data Protection Officer.
    'tool/dataprivacy:managedatarequests' => [
        'riskbitmask' => RISK_SPAM | RISK_PERSONAL | RISK_XSS | RISK_DATALOSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => []
    ],

    // Capability for create new delete data request. Usually given to the site's Protection Officer.
    'tool/dataprivacy:requestdeleteforotheruser' => [
        'riskbitmask' => RISK_SPAM | RISK_PERSONAL | RISK_XSS | RISK_DATALOSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => [],
        'clonepermissionsfrom' => 'tool/dataprivacy:managedatarequests'
    ],

    // Capability for managing the data registry. Usually given to the site's Data Protection Officer.
    'tool/dataprivacy:managedataregistry' => [
        'riskbitmask' => RISK_SPAM | RISK_PERSONAL | RISK_XSS | RISK_DATALOSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => []
    ],

    // Capability for parents/guardians to make data requests on behalf of their children.
    'tool/dataprivacy:makedatarequestsforchildren' => [
        'riskbitmask' => RISK_SPAM | RISK_PERSONAL,
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => []
    ],

    // Capability for parents/guardians to make delete data requests on behalf of their children.
    'tool/dataprivacy:makedatadeletionrequestsforchildren' => [
        'riskbitmask' => RISK_SPAM | RISK_PERSONAL,
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => [],
        'clonepermissionsfrom' => 'tool/dataprivacy:makedatarequestsforchildren'
    ],

    // Capability for users to download the results of their own data request.
    'tool/dataprivacy:downloadownrequest' => [
        'riskbitmask' => 0,
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => [
            'user' => CAP_ALLOW
        ]
    ],

    // Capability for administrators to download other people's data requests.
    'tool/dataprivacy:downloadallrequests' => [
        'riskbitmask' => RISK_PERSONAL,
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => []
    ],

    // Capability for users to create delete data request for their own.
    'tool/dataprivacy:requestdelete' => [
        'riskbitmask' => RISK_DATALOSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => [
            'user' => CAP_ALLOW
        ]
    ]
];
