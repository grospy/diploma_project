<?php
//

/**
 * This file defines tasks performed by the tool.
 *
 * @package    tool_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// List of tasks.
$tasks = array(
    array(
        'classname' => 'tool_analytics\task\train_models',
        'blocking' => 0,
        'minute' => '0',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),
    array(
        'classname' => 'tool_analytics\task\predict_models',
        'blocking' => 0,
        'minute' => '0',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),
);
