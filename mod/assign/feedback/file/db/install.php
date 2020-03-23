<?php
//

/**
 * Post-install code for the assignfeedback_file module.
 *
 * @package assignfeedback_file
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

/**
 * Code run after the assignfeedback_file module database tables have been created.
 * Moves the feedback file plugin down
 *
 * @return bool
 */
function xmldb_assignfeedback_file_install() {
    global $CFG;

    require_once($CFG->dirroot . '/mod/assign/adminlib.php');

    // Set the correct initial order for the plugins.
    $pluginmanager = new assign_plugin_manager('assignfeedback');
    $pluginmanager->move_plugin('file', 'down');

    return true;
}


