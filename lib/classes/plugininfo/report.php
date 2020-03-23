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

use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for admin tool plugins
 */
class report extends base {

    public function is_uninstall_allowed() {
        return true;
    }

    /**
     * Return URL used for management of plugins of this type.
     * @return moodle_url
     */
    public static function get_manage_url() {
        return new moodle_url('/admin/reports.php');
    }
}
