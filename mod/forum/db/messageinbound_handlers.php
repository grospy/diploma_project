<?php
//

/**
 * Message Inbound Handlers for mod_forum.
 *
 * @package    mod_forum
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$handlers = array(
    array(
        'classname' => '\mod_forum\message\inbound\reply_handler',
    ),
);
