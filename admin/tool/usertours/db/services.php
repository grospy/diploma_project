<?php
//

/**
 * List of Web Services for the tool_usertours plugin.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(
    'tool_usertours_fetch_and_start_tour' => array(
        'classname'       => 'tool_usertours\external\tour',
        'methodname'      => 'fetch_and_start_tour',
        'description'     => 'Fetch the specified tour',
        'type'            => 'read',
        'capabilities'    => '',
        'ajax'            => true,
    ),

    'tool_usertours_step_shown' => array(
        'classname'       => 'tool_usertours\external\tour',
        'methodname'      => 'step_shown',
        'description'     => 'Mark the specified step as completed for the current user',
        'type'            => 'write',
        'capabilities'    => '',
        'ajax'            => true,
    ),

    'tool_usertours_complete_tour' => array(
        'classname'       => 'tool_usertours\external\tour',
        'methodname'      => 'complete_tour',
        'description'     => 'Mark the specified tour as completed for the current user',
        'type'            => 'write',
        'capabilities'    => '',
        'ajax'            => true,
    ),

    'tool_usertours_reset_tour' => array(
        'classname'       => 'tool_usertours\external\tour',
        'methodname'      => 'reset_tour',
        'description'     => 'Remove the specified tour',
        'type'            => 'write',
        'capabilities'    => '',
        'ajax'            => true,
    ),
);
