<?php
//

/**
 * This file renders the quiz overview graph.
 *
 * @package   quiz_overview
 * @copyright 2008 Jamie Pratt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @deprecated since Moodle 3.2
 */


require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir . '/filelib.php');

debugging('This way of generating the chart is deprecated, refer to quiz_overview_report::display().', DEBUG_DEVELOPER);
send_file_not_found();
