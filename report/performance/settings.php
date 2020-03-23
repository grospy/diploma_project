<?php
//

/**
 * Settings and links
 *
 * @package   report_performance
 * @copyright 2013 Rajesh Taneja
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('reportperformance', get_string('pluginname', 'report_performance'),
        $CFG->wwwroot."/report/performance/index.php", 'report/performance:view'));

// No report settings.
$settings = null;
