<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * Base class for course report backup plugins.
 *
 * NOTE: When you back up a course, it potentially may run backup for all
 * course reports. In order to control whether a particular report gets
 * backed up, a course report should make use of the second and third
 * parameters in get_plugin_element().
 *
 * @package     core_backup
 * @subpackage  moodle2
 * @category    backup
 * @copyright   2011 onwards The Open University
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class backup_coursereport_plugin extends backup_plugin {
    // Use default parent behaviour
}
