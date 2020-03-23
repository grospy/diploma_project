<?php
//

/**
 * Graph
 *
 * @package    report
 * @subpackage courseoverview
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->libdir . '/filelib.php');

debugging('This way of generating the chart is deprecated, refer to report_courseoverview_print_chart().', DEBUG_DEVELOPER);
send_file_not_found();
