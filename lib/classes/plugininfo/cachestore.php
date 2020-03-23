<?php
//

/**
 * Defines classes used for plugin info.
 *
 * @package    core
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\plugininfo;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for cache store plugins
 */
class cachestore extends base {

    public function is_uninstall_allowed() {
        $instance = \cache_config::instance();
        foreach ($instance->get_all_stores() as $store) {
            if ($store['plugin'] == $this->name) {
                return false;
            }
        }
        return true;
    }
}
