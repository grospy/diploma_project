<?php
//

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     repository_flickr
 * @category    upgrade
 * @copyright   2017 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute repository_flickr upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_repository_flickr_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2017082200) {
        // Drop legacy flickr auth tokens and nsid's.
        $DB->delete_records('user_preferences', ['name' => 'flickr_']);
        $DB->delete_records('user_preferences', ['name' => 'flickr__nsid']);

        upgrade_plugin_savepoint(true, 2017082200, 'repository', 'flickr');
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
