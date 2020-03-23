<?php
//

/**
 * Grade overview report upgrade steps.
 *
 * @package    gradereport_overview
 * @copyright  2017 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade grade overview report.
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_gradereport_overview_upgrade($oldversion) {

    if ($oldversion < 2017051501) {
        $context = context_system::instance();
        $capability = 'gradereport/overview:view';

        // Now allow authenticated user role to access that report.
        $authenticateduserroles = get_archetype_roles('user');
        foreach ($authenticateduserroles as $roleid => $notused) {
            assign_capability($capability, CAP_ALLOW, $roleid, $context->id);
        }

        upgrade_plugin_savepoint(true, 2017051501, 'gradereport', 'overview');
    }

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
