<?php

//

/**
 * Defines the version of workshop Number of errors grading strategy subplugin
 *
 * This code fragment is called by moodle_needs_upgrading() and
 * /admin/index.php
 *
 * @package    workshopform_numerrors
 * @copyright  2009 David Mudrak <david.mudrak@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version  = 2019111800;
$plugin->requires = 2019111200;  // Requires this Moodle version.
$plugin->component = 'workshopform_numerrors';
