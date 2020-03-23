<?php
//

/**
 * Dummy storage manager, returns nothing.
 * used when no other manager available.
 *
 * @package    core
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\log;

defined('MOODLE_INTERNAL') || die();

class dummy_manager implements manager {
    public function get_readers($interface = null) {
        return array();
    }

    public function dispose() {
    }

    public function get_supported_logstores($component) {
        return array();
    }
}
