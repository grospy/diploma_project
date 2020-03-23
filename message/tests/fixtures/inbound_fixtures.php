<?php
//

/**
 * Fixtures for Inbound Message tests.
 *
 * @package    core_message
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\test;
defined('MOODLE_INTERNAL') || die();

/**
 * A base handler for unit testing.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class handler_base extends \core\message\inbound\handler {
    /**
     * Get the description for unit tests.
     */
    public function get_description() {
    }

    /**
     * Get the name for unit tests.
     */
    public function get_name() {
    }

    /**
     * Process a message for unit tests.
     *
     * @param stdClass $record The record to process
     * @param stdClass $messagedata The message data
     */
    public function process_message(\stdClass $record, \stdClass $messagedata) {
    }
}

/**
 * A handler for unit testing.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class handler_one extends handler_base {
}

/**
 * A handler for unit testing.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class handler_two extends handler_base {
}

/**
 * A handler for unit testing.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class handler_three extends handler_base {
}

/**
 * A handler for unit testing.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class handler_four extends handler_base {
}
