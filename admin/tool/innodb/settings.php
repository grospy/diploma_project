<?php
//

/**
 * Link to InnoDB conversion tool
 *
 * @package    tool
 * @subpackage innodb
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('unsupported', new admin_externalpage('toolinnodb', 'Convert to InnoDB', $CFG->wwwroot.'/'.$CFG->admin.'/tool/innodb/index.php', 'moodle/site:config', true));
}
