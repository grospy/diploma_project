<?php
//

/**
 * Message providers list.
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$messageproviders = array (
    // Notify a user that a rule has happened.
    'notification' => array (
        'capability'  => 'tool/monitor:subscribe'
    )
);
