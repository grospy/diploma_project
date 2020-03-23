<?php
//

/**
 * Definition of langimport tasks
 *
 * @package   tool_langimport
 * @category  task
 * @copyright 2014 Dan Poltawski <dan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'tool_langimport\task\update_langpacks_task',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => '4',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*'
    )
);
