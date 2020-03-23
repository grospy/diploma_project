<?php
//

/**
 * Version information for the drag-and-drop words into sentences question type.
 *
 * @package   qtype_ddwtos
 * @copyright 2011 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;
$plugin->requires  = 2019111200;

$plugin->component = 'qtype_ddwtos';
$plugin->maturity  = MATURITY_STABLE;

$plugin->dependencies = array(
    'qtype_gapselect' => 2019111200,
);
