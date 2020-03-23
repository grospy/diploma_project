<?php
//

/**
 * Variable Envelope Return Path message processing failure exception.
 *
 * @package    core_message
 * @copyright  2014 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\message\inbound;

defined('MOODLE_INTERNAL') || die();

/**
 * Variable Envelope Return Path message processing failure exception.
 *
 * @copyright  2014 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class processing_failed_exception extends \moodle_exception {
    /**
     * Constructor
     *
     * @param string $identifier The string identifier to use when displaying this exception.
     * @param string $component The string component
     * @param \stdClass $data The data to pass to get_string
     */
    public function __construct($identifier, $component, \stdClass $data = null) {
        return parent::__construct($identifier, $component, '', $data);
    }
}
