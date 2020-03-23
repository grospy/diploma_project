<?php
//

/**
 * Plugin capabilities.
 *
 * @package   tool_usertours
 * @copyright 2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'tool/usertours:managetours' => [
        'captype' => 'write',
        'riskbitmask' => RISK_XSS,
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => [
            'manager' => CAP_ALLOW,
        ]
    ],
);
