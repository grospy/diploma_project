<?php
//

/**
 * Defines classes used for plugin info.
 *
 * @package    core
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\plugininfo;

use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for admin tool plugins
 */
class tool extends base {

    public function is_uninstall_allowed() {
        // Some mobile settings are used by the core.
        if ($this->name === 'mobile') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Tools cannot be disabled.
     *
     * @return boolean
     */
    public function is_enabled() {
        return true;
    }

    /**
     * Return URL used for management of plugins of this type.
     * @return moodle_url
     */
    public static function get_manage_url() {
        return new moodle_url('/admin/tools.php');
    }

    /**
     * Loads plugin settings to the settings tree
     *
     * This function usually includes settings.php file in plugins folder.
     * Alternatively it can create a link to some settings page (instance of admin_externalpage)
     *
     * @param \part_of_admin_tree $adminroot
     * @param string $parentnodename
     * @param bool $hassiteconfig whether the current user has moodle/site:config capability
     */
    public function load_settings(\part_of_admin_tree $adminroot, $parentnodename, $hassiteconfig) {
        global $CFG, $USER, $DB, $OUTPUT, $PAGE; // In case settings.php wants to refer to them.
        $ADMIN = $adminroot; // May be used in settings.php.
        $plugininfo = $this; // Also can be used inside settings.php.

        if (!$this->is_installed_and_upgraded()) {
            return;
        }

        if (file_exists($this->full_path('settings.php'))) {
            include($this->full_path('settings.php'));
        }
    }
}
