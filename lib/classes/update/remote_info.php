<?php
//

/**
 * Provides \core\update\remote_info class.
 *
 * @package     core_plugin
 * @copyright   2015 David Mudrak <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\update;
use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * Thin wrapper for data structures returned by {@link api::get_plugin_info()}
 *
 * Given that the API client returns instances of this class instead of pure
 * objects allows us to have proper type hinting / declarations in method
 * signatures. The validation of the data structure is happening in the API
 * client so the rest of the code can simply rely on the class type.
 *
 * We extend the stdClass explicitly so that it can be eventually used in
 * methods signatures, too (not recommended).
 *
 * @copyright 2015 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class remote_info extends stdClass {
}
