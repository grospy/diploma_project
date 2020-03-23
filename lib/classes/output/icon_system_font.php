<?php
//

/**
 * Contains class \core\output\icon_system
 *
 * @package    core
 * @category   output
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Class allowing different systems for mapping and rendering icons.
 *
 * Possible icon styles are:
 *   1. standard - image tags are generated which point to pix icons stored in a plugin pix folder.
 *   2. fontawesome - font awesome markup is generated with the name of the icon mapped from the moodle icon name.
 *   3. inline - inline tags are used for svg and png so no separate page requests are made (at the expense of page size).
 *
 * @package    core
 * @category   output
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class icon_system_font extends icon_system {

}

