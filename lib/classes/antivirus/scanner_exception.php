<?php
//

/**
 * Exception for antivirus.
 *
 * @package    core_antivirus
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\antivirus;

defined('MOODLE_INTERNAL') || die();

/**
 * An antivirus scanner exception class.
 *
 * @package    core
 * @subpackage antivirus
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class scanner_exception extends \moodle_exception {
    /**
     * Constructs a new exception
     *
     * @param string $errorcode
     * @param string $link
     * @param mixed $a
     * @param mixed $debuginfo
     */
    public function __construct($errorcode, $link = '', $a = null, $debuginfo = null) {
        parent::__construct($errorcode, 'antivirus', $link, $a, $debuginfo);
    }
}
