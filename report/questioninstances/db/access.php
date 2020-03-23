<?php
//

/**
 * Capabilities
 *
 * @package    report_questioninstances
 * @copyright  2008 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'report/questioninstances:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        ),

        'clonepermissionsfrom' => 'moodle/site:config',
    )
);
