<?php
//

/**
 * Links and settings
 *
 * Contains settings used by logs report.
 *
 * @package    report_log
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Just a link to course report.
$ADMIN->add('reports', new admin_externalpage('reportlog', get_string('log', 'admin'),
        $CFG->wwwroot . "/report/log/index.php?id=0", 'report/log:view'));

// No report settings.
$settings = null;
