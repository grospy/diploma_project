<?php
//

/**
 * The mod_lti instance list viewed event.
 *
 * @package    mod_lti
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lti\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_lti instance list viewed event class.
 *
 * @package    mod_lti
 * @since      Moodle 2.7
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class course_module_instance_list_viewed extends \core\event\course_module_instance_list_viewed {
    // No need for any code here as everything is handled by the parent class.
}
