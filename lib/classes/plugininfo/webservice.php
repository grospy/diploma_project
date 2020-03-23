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

use part_of_admin_tree, admin_settingpage;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for webservice protocols
 */
class webservice extends base {
    /**
     * Finds all enabled plugins, the result may include missing plugins.
     * @return array of enabled plugins $pluginname => $pluginname
     */
    public static function get_enabled_plugins() {
        global $CFG;

        if (empty($CFG->enablewebservices) or empty($CFG->webserviceprotocols)) {
            return array();
        }

        $enabled = array();
        foreach (explode(',', $CFG->webserviceprotocols) as $protocol) {
            $enabled[$protocol] = $protocol;
        }

        return $enabled;
    }

    public function get_settings_section_name() {
        return 'webservicesetting' . $this->name;
    }

    public function load_settings(part_of_admin_tree $adminroot, $parentnodename, $hassiteconfig) {
        global $CFG, $USER, $DB, $OUTPUT, $PAGE; // In case settings.php wants to refer to them.
        $ADMIN = $adminroot; // May be used in settings.php.
        $plugininfo = $this; // Also can be used inside settings.php.
        $webservice = $this; // Also can be used inside settings.php.

        if (!$this->is_installed_and_upgraded()) {
            return;
        }

        if (!$hassiteconfig or !file_exists($this->full_path('settings.php'))) {
            return;
        }

        $section = $this->get_settings_section_name();

        $settings = new admin_settingpage($section, $this->displayname, 'moodle/site:config', $this->is_enabled() === false);
        include($this->full_path('settings.php')); // This may also set $settings to null.

        if ($settings) {
            $ADMIN->add($parentnodename, $settings);
        }
    }

    public function is_uninstall_allowed() {
        // The xmlrpc plugin contains webservice_xmlrpc_client (used by core).
        if ($this->name == 'xmlrpc') {
            return false;
        }
        return true;
    }
}
