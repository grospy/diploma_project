<?php
//

/**
 * Version info
 *
 * @package    block_completionstatus
 * @copyright  2009 Catalyst IT Ltd
 * @author     Aaron Barnes <aaronb@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version      = 2019111800; // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires     = 2019111200; // Requires this Moodle version.
$plugin->component    = 'block_completionstatus';
$plugin->dependencies = array('report_completion' => 2019111200);
