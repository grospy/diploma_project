<?php
//

/**
 * Invalid persistent exception.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_competency;

defined('MOODLE_INTERNAL') || die();

debugging('The class core_competency\\invalid_persistent_exception is deprecated. ' .
    'Please use core\\invalid_persistent_exception instead.');

/**
 * Invalid persistent exception class.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @deprecated since Moodle 3.3
 */
class invalid_persistent_exception extends \core\invalid_persistent_exception {
}
