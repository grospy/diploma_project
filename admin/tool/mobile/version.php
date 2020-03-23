<?php
//

/**
 * Plugin version info
 *
 * @package    tool_mobile
 * @copyright  2016 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
$plugin->version   = 2019111800; // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires  = 2019111200; // Requires this Moodle version.
$plugin->component = 'tool_mobile'; // Full name of the plugin (used for diagnostics).
$plugin->dependencies = array(
    'webservice_rest' => 2019111200
);
