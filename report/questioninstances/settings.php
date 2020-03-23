<?php
//

/**
 * Settings and links
 *
 * @package    report
 * @subpackage questioninstances
 * @copyright  2008 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('reportquestioninstances', get_string('pluginname', 'report_questioninstances'), "$CFG->wwwroot/report/questioninstances/index.php", 'report/questioninstances:view'));

// no report settings
$settings = null;
