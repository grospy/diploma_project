<?php
//

/**
 * Subplugin info class.
 *
 * @package   mod_scorm
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_scorm\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();


class scormreport extends base {
    public function is_uninstall_allowed() {
        return true;
    }
}
