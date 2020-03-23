<?php
//

/**
 * Handlers for tool_messageinbound.
 *
 * @package    tool_messageinbound
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$handlers = array(
    array(
        'classname'         => '\tool_messageinbound\message\inbound\invalid_recipient_handler',
        'enabled'           => true,
        'validateaddress'   => false,
    ),
);
