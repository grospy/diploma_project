<?php
//

/**
 * Course module instances list_viewed event.
 *
 * This class has been deprecated, please use \core\event\course_module_instance_list_viewed.
 *
 * @package    core
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

debugging('core\\event\\course_module_instances_list_viewed has been deperecated. Please use
        core\\event\\course_module_instance_list_viewed instead', DEBUG_DEVELOPER);

/**
 * This class has been deprecated, please use \core\event\course_module_instance_list_viewed.
 *
 * @deprecated Since Moodle 2.7
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class course_module_instances_list_viewed extends course_module_instance_list_viewed {
    /**
     * This event has been deprected.
     *
     * @return boolean
     */
    public static function is_deprecated() {
        return true;
    }
}
