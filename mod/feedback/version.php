<?php
//

/**
 * Feedback version information
 *
 * @package mod_feedback
 * @author     Andreas Grabs
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;       // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;    // Requires this Moodle version
$plugin->component = 'mod_feedback';   // Full name of the plugin (used for diagnostics)
$plugin->cron      = 0;

$feedback_version_intern = 1; //this version is used for restore older backups
