<?php

//

/**
 * Library of functions and constants for module label
 *
 * @package mod_label
 * @copyright  2003 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");
require_once("lib.php");

$id = required_param('id',PARAM_INT);   // course

$PAGE->set_url('/mod/label/index.php', array('id'=>$id));

redirect("$CFG->wwwroot/course/view.php?id=$id");


