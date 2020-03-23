<?php
//

/**
 * Subplugin info class.
 *
 * @package   editor_atto
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace editor_atto\plugininfo;

use core\plugininfo\base;

defined('MOODLE_INTERNAL') || die();


class atto extends base {

    /**
     * Yes you can uninstall these plugins if you want.
     * @return \moodle_url
     */
    public function is_uninstall_allowed() {
        return true;
    }

    /**
     * Return URL used for management of plugins of this type.
     * @return \moodle_url
     */
    public static function get_manage_url() {
        return new \moodle_url('/admin/settings.php', array('section'=>'editorsettingsatto'));
    }

    /**
     * Include the settings.php file from sub plugins if they provide it.
     * This is a copy of very similar implementations from various other subplugin areas.
     *
     * @return \moodle_url
     */
    public function load_settings(\part_of_admin_tree $adminroot, $parentnodename, $hassiteconfig) {
        global $CFG, $USER, $DB, $OUTPUT, $PAGE; // In case settings.php wants to refer to them.
        $ADMIN = $adminroot; // May be used in settings.php.
        $plugininfo = $this; // Also can be used inside settings.php.

        if (!$this->is_installed_and_upgraded()) {
            return;
        }

        if (!$hassiteconfig or !file_exists($this->full_path('settings.php'))) {
            return;
        }

        $section = $this->get_settings_section_name();
        $settings = new \admin_settingpage($section, $this->displayname, 'moodle/site:config', $this->is_enabled() === false);
        include($this->full_path('settings.php')); // This may also set $settings to null.

        if ($settings) {
            $ADMIN->add($parentnodename, $settings);
        }
    }

    /**
     * Get the settings section name.
     * It's used to get the setting links in the Atto sub-plugins table.
     *
     * @return null|string the settings section name.
     */
    public function get_settings_section_name() {
        return 'atto_' . $this->name . '_settings';
    }
}
