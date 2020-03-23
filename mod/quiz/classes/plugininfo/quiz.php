<?php
//

/**
 * Subplugin info class.
 *
 * @package   mod_quiz
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_quiz\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();


class quiz extends base {
    public function is_uninstall_allowed() {
        return true;
    }

    /**
     * Pre-uninstall hook.
     *
     * This is intended for disabling of plugin, some DB table purging, etc.
     *
     * NOTE: to be called from uninstall_plugin() only.
     * @private
     */
    public function uninstall_cleanup() {
        global $DB;

        // Do the opposite of db/install.php scripts - deregister the report.

        $DB->delete_records('quiz_reports', array('name'=>$this->name));

        parent::uninstall_cleanup();
    }
}
