<?php
//

/**
 * Subplugin info class.
 *
 * @package   mod_assignment
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_assignment\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();


class assignment extends base {
    /**
     * Returns the information about plugin availability
     *
     * True means that the plugin is enabled. False means that the plugin is
     * disabled. Null means that the information is not available, or the
     * plugin does not support configurable availability or the availability
     * can not be changed.
     *
     * @return null|bool
     */
    public function is_enabled() {
        return false;
    }
}
