<?php
//

/**
 * Link to user roles management.
 *
 * @package    tool_cohortroles
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// This tool's required capabilities.
$capabilities = [
    'moodle/cohort:view',
    'moodle/role:manage'
];

// Check if the user has all of the required capabilities.
$context = context_system::instance();
$hasaccess = has_all_capabilities($capabilities, $context);

// Add this admin page only if the user has all of the required capabilities.
if ($hasaccess) {
    $str = get_string('managecohortroles', 'tool_cohortroles');
    $url = new moodle_url('/admin/tool/cohortroles/index.php');
    $ADMIN->add('roles', new admin_externalpage('toolcohortroles', $str, $url, $capabilities));
}
