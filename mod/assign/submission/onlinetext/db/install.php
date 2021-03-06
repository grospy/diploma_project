<?php
//

/**
 * Post-install code for the submission_onlinetext module.
 *
 * @package assignsubmission_onlinetext
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();


/**
 * Code run after the assignsubmission_onlinetext module database tables have been created.
 * Moves the plugin to the top of the list (of 3)
 * @return bool
 */
function xmldb_assignsubmission_onlinetext_install() {
    global $CFG;

    // Set the correct initial order for the plugins.
    require_once($CFG->dirroot . '/mod/assign/adminlib.php');
    $pluginmanager = new assign_plugin_manager('assignsubmission');

    $pluginmanager->move_plugin('onlinetext', 'up');
    $pluginmanager->move_plugin('onlinetext', 'up');

    return true;
}
