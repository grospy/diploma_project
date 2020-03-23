<?php
//

/**
 * The mod_folder instance list viewed event.
 *
 * @package    mod_folder
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_folder\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_folder instance list viewed event class.
 *
 * @package    mod_folder
 * @since      Moodle 2.7
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_instance_list_viewed extends \core\event\course_module_instance_list_viewed {
    // No code required here as the parent class handles it all.
}
