<?php
//

/**
 * Tool xmldb external functions and service definitions.
 *
 * @package    tool_xmldb
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    'tool_xmldb_invoke_move_action' => [
        'classname' => tool_xmldb_external::class,
        'methodname' => 'invoke_move_action',
        'description' => 'moves element up/down',
        'type' => 'write',
        'ajax' => true,
    ]
];
