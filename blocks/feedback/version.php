<?php
//

/**
 * Version details
 *
 * @package    block_feedback
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;        // Requires this Moodle version
$plugin->component = 'block_feedback';  // Full name of the plugin (used for diagnostics)

$plugin->dependencies = array('mod_feedback' => 2019111200);
