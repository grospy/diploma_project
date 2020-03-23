<?php
//

/**
 * Settings and links
 *
 * @package    report
 * @subpackage security
 * @copyright  2008 petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('reportsecurity', get_string('pluginname', 'report_security'), "$CFG->wwwroot/report/security/index.php",'report/security:view'));

// no report settings
$settings = null;
