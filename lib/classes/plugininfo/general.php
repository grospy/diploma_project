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

defined('MOODLE_INTERNAL') || die();


/**
 * General class for all plugin types that do not have their own class
 */
class general extends base {
    public function is_uninstall_allowed() {
        return false;
    }
}
