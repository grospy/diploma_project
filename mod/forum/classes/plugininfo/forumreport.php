<?php
//

/**
 * Subplugin info class.
 *
 * @package   mod_forum
 * @copyright 2019 Michael Hawkins <michaelh@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_forum\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();

/**
 * Forum report subplugin info class.
 *
 * @copyright 2019 Michael Hawkins <michaelh@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class forumreport extends base {
    /**
     * Allow the forum report subplugin be uninstalled.
     *
     * @return boolean
     */
    public function is_uninstall_allowed() {
        return true;
    }
}
