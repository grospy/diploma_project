<?php
//

/**
 * Report settings
 *
 * @package    report
 * @subpackage courseoverview
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('reportcourseoverview', get_string('pluginname', 'report_courseoverview'), "$CFG->wwwroot/report/courseoverview/index.php",'report/courseoverview:view', empty($CFG->enablestats)));

// no report settings
$settings = null;
