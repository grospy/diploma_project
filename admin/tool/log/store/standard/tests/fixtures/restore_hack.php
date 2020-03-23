<?php
//

/**
 * Restore controller hackery.
 *
 * @package    tool_log
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');

class logstore_standard_restore extends restore_controller {
    public static function hack_executing($state) {
        self::$executing = $state;
    }
}
