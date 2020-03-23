<?php
//

/**
 * Defines classes used for plugin info.
 *
 * @package    core
 * @copyright  2015 Daniel Neis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\plugininfo;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for search plugins
 *
 * @package    core
 * @copyright  2015 Daniel Neis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search extends base {

    /**
     * Is uninstall allowed or not.
     *
     * @return bool
     */
    public function is_uninstall_allowed() {
        return true;
    }

    /**
     * Returns the node name used in admin settings menu for this plugin settings (if applicable).
     *
     * @return null|string node name or null if plugin does not create settings node (default)
     */
    public function get_settings_section_name() {
        return 'searchsetting' . $this->name;
    }
}
