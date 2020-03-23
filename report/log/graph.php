<?php
//

/**
 * Produces a graph of log accesses for a user
 *
 * Generates an image representing the log data in a graphical manner for a user.
 *
 * @package    report_log
 * @deprecated since 3.2
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require("../../config.php");
require_once($CFG->libdir . '/filelib.php');

debugging('This way of generating the chart is deprecated, refer to report_log_print_graph().', DEBUG_DEVELOPER);
send_file_not_found();
