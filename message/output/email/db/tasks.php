<?php
//

/**
 * This file defines tasks performed by the plugin.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// List of tasks.
$tasks = array(
    array(
        'classname' => 'message_email\task\send_email_task',
        'blocking' => 0,
        'minute' => 0,
        'hour' => 22,
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    )
);
