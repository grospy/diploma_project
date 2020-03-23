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


class quizaccess extends base {
    public function is_uninstall_allowed() {
        // Only allow uninstall of non-core access rules.
        return !$this->is_standard();
    }
}
