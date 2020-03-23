<?php
//

/**
 * The mod_imscp instance list viewed event.
 *
 * @package    mod_imscp
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_imscp\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_imscp instance list viewed event class.
 *
 * @package    mod_imscp
 * @since      Moodle 2.7
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_instance_list_viewed extends \core\event\course_module_instance_list_viewed {
    // No code required here as the parent class handles it all.
}
