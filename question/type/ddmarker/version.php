<?php
//

/**
 * Version information for the drag-and-drop markers question type.
 *
 * @package   qtype_ddmarker
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;
$plugin->requires  = 2019111200;

$plugin->component = 'qtype_ddmarker';
$plugin->maturity  = MATURITY_STABLE;

$plugin->dependencies = array(
    'qtype_gapselect'     => 2019111200,
    'qtype_ddimageortext' => 2019111200,
);
