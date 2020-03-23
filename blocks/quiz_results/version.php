<?php
//

/**
 * Version information for the block_quiz_results plugin.
 *
 * @package    block_quiz_results
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;        // Requires this Moodle version
$plugin->component = 'block_quiz_results'; // Full name of the plugin (used for diagnostics)

$plugin->dependencies = array('mod_quiz' => 2019111200);
