<?php
//

/**
 * Plugin version info.
 *
 * @package    tool_lpmigrate
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800; // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires  = 2019111200; // Requires this Moodle version.
$plugin->component = 'tool_lpmigrate'; // Full name of the plugin (used for diagnostics).
$plugin->dependencies = array(
    'tool_lp' => ANY_VERSION
);
