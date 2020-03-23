<?php
//

/**
 * Subplugin info class.
 *
 * @package   mod_data
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_data\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();


class datafield extends base {
    public function is_uninstall_allowed() {
        global $DB;
        return !$DB->record_exists('data_fields', array('type'=>$this->name));
    }
}
