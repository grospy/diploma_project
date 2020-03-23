<?php
//

/**
 * Defines classes used for updates.
 *
 * @package    core
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\update;

defined('MOODLE_INTERNAL') || die();

/**
 * General exception thrown by the {@link \core\update\checker} class
 */
class checker_exception extends \moodle_exception {

    /**
     * @param string $errorcode exception description identifier
     * @param mixed $debuginfo debugging data to display
     */
    public function __construct($errorcode, $debuginfo=null) {
        parent::__construct($errorcode, 'core_plugin', '', null, print_r($debuginfo, true));
    }
}
