<?php
//

/**
 * Display H5P upgrade code
 *
 * @package    filter_displayh5p
 * @copyright  2019 Amaia Anabitarte <amaia@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * xmldb_filter_displayh5p_upgrade
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_filter_displayh5p_upgrade($oldversion) {
    global $CFG;

    require_once($CFG->dirroot . '/filter/displayh5p/db/upgradelib.php');

    if ($oldversion < 2019110800) {
        // We need to move up the displayh5p filter over urltolink and activitynames filters to works properly.
        filter_displayh5p_reorder();

        upgrade_plugin_savepoint(true, 2019110800, 'filter', 'displayh5p');
    }

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
