<?php
//

/**
 * Backup support for tool_log logstore subplugins.
 *
 * @package    tool_log
 * @category   backup
 * @copyright  2015 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Parent class of all the logstore subplugin implementations.
 *
 * Note: While this intermediate class is not strictly required and all the
 * subplugin implementations can extend directly {@link backup_subplugin},
 * it is always recommended to have it, both for better testing and also
 * for sharing code between all subplugins.
 */
abstract class backup_tool_log_logstore_subplugin extends backup_subplugin {
}
