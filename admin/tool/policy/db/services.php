<?php
//

/**
 * Tool policy external functions and service definitions.
 *
 * @package    tool_policy
 * @category   external
 * @copyright  2018 Sara Arjona (sara@moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    'tool_policy_get_policy_version' => [
        'classname'     => 'tool_policy\external',
        'methodname'    => 'get_policy_version',
        'classpath'     => '',
        'description'   => 'Fetch the details of a policy version',
        'type'          => 'read',
        'capabilities'  => '',
        'ajax'          => true,
        'loginrequired' => false,
    ],

    'tool_policy_submit_accept_on_behalf' => [
        'classname'     => 'tool_policy\external',
        'methodname' => 'submit_accept_on_behalf',
        'classpath' => '',
        'description' => 'Accept policies on behalf of other users',
        'ajax' => true,
        'type' => 'write',
    ],
];
