<?php
//

/**
 * The mod_glossary instance list viewed event.
 *
 * @package    mod_glossary
 * @copyright  2014 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_glossary\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_glossary instance list viewed event class.
 *
 * @package    mod_glossary
 * @since      Moodle 2.7
 * @copyright  2014 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_instance_list_viewed extends \core\event\course_module_instance_list_viewed {
    // No code required here as the parent class handles it all.
}

