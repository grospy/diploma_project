<?php
//

/**
 * Add hidden links db transfer tool
 *
 * @package    tool_dbtransfer
 * @copyright  2011 Petr Skoda {@link http://skodak.org/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('experimental', new admin_externalpage('tooldbtransfer', get_string('dbtransfer', 'tool_dbtransfer'),
        $CFG->wwwroot.'/'.$CFG->admin.'/tool/dbtransfer/index.php', 'moodle/site:config', false));
    // DB export/import is not ready yet - keep it hidden for now.
    $ADMIN->add('experimental', new admin_externalpage('tooldbexport', get_string('dbexport', 'tool_dbtransfer'),
        $CFG->wwwroot.'/'.$CFG->admin.'/tool/dbtransfer/dbexport.php', 'moodle/site:config', true));
}
