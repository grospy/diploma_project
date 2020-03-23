<?php
//

/**
 * This file defines what events we wish to observe and the method responsible for handling the event.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname' => '\core\event\message_viewed',
        'callback' => '\message_email\event_observers::message_viewed',
    ],
];
