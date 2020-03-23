<?php
//

/**
 * Mobile app support.
 *
 * @package    tool_mobile
 * @copyright  2019 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/lib/upgradelib.php');

/**
 * Upgrade the plugin.
 *
 * @param int $oldversion
 * @return bool always true
 */
function xmldb_tool_mobile_upgrade($oldversion) {
    global $CFG;

    if ($oldversion < 2019021100) {
        $disabledfeatures = get_config('tool_mobile', 'disabledfeatures');
        $disabledfeatures = str_replace('remoteAddOn_', 'sitePlugin_', $disabledfeatures);
        set_config('disabledfeatures', $disabledfeatures, 'tool_mobile');
        upgrade_plugin_savepoint(true, 2019021100, 'tool', 'mobile');
    }

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
