<?php
//

/**
 * Settings for the backups report
 *
 * @package    report
 * @subpackage backups
 * @copyright  2007 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('reportbackups', get_string('backups', 'admin'), "$CFG->wwwroot/report/backups/index.php",'moodle/backup:backupcourse'));

// no report settings
$settings = null;