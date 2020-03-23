<?php
//

/**
 * Capabilities for category access plugin.
 *
 * @package    enrol_category
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    // Marks roles that have category role assignments synchronised to course enrolments
    // overrides below system context are ignored (for performance reasons).
    // By default his is not allowed in new installs, admins have to explicitly allow category enrolments.
    'enrol/category:synchronised' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
        )
    ),
    'enrol/category:config' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        )
    ),
);


