<?php
//

/**
 * This file defines observers needed by the plugin.
 *
 * @package    tool_policy
 * @copyright   2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => '\core\event\user_created',
        'callback'    => '\tool_policy\api::create_acceptances_user_created',
    ],
];
