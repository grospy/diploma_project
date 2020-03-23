<?php
//

/**
 * This file is part of the User section Moodle
 *
 * @package    report
 * @subpackage stats
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->libdir . '/filelib.php');

debugging('This way of generating the chart is deprecated, refer to report_stats_print_chart().', DEBUG_DEVELOPER);
send_file_not_found();
