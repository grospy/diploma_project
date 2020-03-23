<?php
//

/**
 * This file defines tasks performed by the tool.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// List of tasks.
$tasks = array(
    array(
        'classname' => 'tool_dataprivacy\task\expired_retention_period',
        'blocking' => 0,
        'minute' => '0',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ), array(
        'classname' => 'tool_dataprivacy\task\delete_expired_contexts',
        'blocking' => 0,
        'minute' => '0',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ), array(
        'classname' => 'tool_dataprivacy\task\delete_expired_requests',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ), array(
        'classname' => 'tool_dataprivacy\task\delete_existing_deleted_users',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*',
        'disabled' => true,
    ),
);
