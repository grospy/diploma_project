<?php
//

/**
 * This script renders the quiz statistics graph.
 *
 * It takes one parameter, the quiz_statistics.id. This is enough to identify the
 * quiz etc.
 *
 * It plots a bar graph showing certain question statistics plotted against
 * question number.
 *
 * @package   quiz_statistics
 * @copyright 2008 Jamie Pratt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @deprecated since Moodle 3.2
 */

require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir . '/filelib.php');

debugging('This way of generating the chart is deprecated, refer to quiz_statistics_report::display().', DEBUG_DEVELOPER);
send_file_not_found();
