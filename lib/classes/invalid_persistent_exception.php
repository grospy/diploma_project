<?php
//

/**
 * Invalid persistent exception.
 *
 * @package    core
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core;

defined('MOODLE_INTERNAL') || die();

/**
 * Invalid persistent exception class.
 *
 * @package    core
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class invalid_persistent_exception extends \moodle_exception {

    public function __construct(array $errors = array()) {
        $forhumans = array();
        $debuginfo = array();
        foreach ($errors as $key => $message) {
            $debuginfo[] = "$key: $message";
            $forhumans[] = $message;
        }
        parent::__construct('invalidpersistenterror', 'core', null,
                implode(', ', $forhumans), implode(' - ', $debuginfo));
    }

}
