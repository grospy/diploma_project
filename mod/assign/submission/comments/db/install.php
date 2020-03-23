<?php
//

/**
 * Post-install code for the submission_comments module.
 *
 * @package assignsubmission_comments
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Code run after the module database tables have been created.
 * Moves the comments plugin to the bottom
 * @return bool
 */
function xmldb_assignsubmission_comments_install() {
    global $CFG;

    require_once($CFG->dirroot . '/mod/assign/adminlib.php');
    // Set the correct initial order for the plugins.
    $pluginmanager = new assign_plugin_manager('assignsubmission');

    $pluginmanager->move_plugin('comments', 'down');
    $pluginmanager->move_plugin('comments', 'down');

    return true;
}
