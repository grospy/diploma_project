<?php
//

/**
 * Report settings
 *
 * @package    report
 * @subpackage configlog
 * @copyright  2009 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('reportconfiglog', get_string('configlog', 'report_configlog'), "$CFG->wwwroot/report/configlog/index.php"));

// no report settings
$settings = null;
