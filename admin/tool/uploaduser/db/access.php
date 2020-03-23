<?php
//

/**
 * Defines the capabilities used by the user upload admin tool
 *
 * @package    tool_uploaduser
 * @copyright  2013 Dan Poltawski <dan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    // Allows the user to upload user pictures.
    'tool/uploaduser:uploaduserpictures' => array(
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        ),
        'clonepermissionsfrom' =>  'moodle/site:uploadusers',
    ),
);
