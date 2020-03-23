<?php
//

/**
 * Subplugin info class.
 *
 * @package   mod_workshop
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_workshop\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();


class workshopallocation extends base {
    public function is_uninstall_allowed() {
        if ($this->is_standard()) {
            return false;
        }
        return true;
    }
}
