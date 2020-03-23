<?php
//

/**
 * This file defines observers needed by the plugin.
 *
 * @package    tool_dataprivacy
 * @copyright   2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => '\core\event\user_deleted',
        'callback'    => '\tool_dataprivacy\event\user_deleted_observer::create_delete_data_request',
    ],
];
