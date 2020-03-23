<?php
//

/**
 * Definition of repository_onedrive scheduled tasks.
 *
 * The handlers defined on this file are processed and registered into
 * the Moodle DB after any install or upgrade operation. All plugins
 * support this.
 *
 * @package   repository_onedrive
 * @copyright 2017 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* List of handlers */

$tasks = array(
    array(
        'classname' => 'repository_onedrive\remove_temp_access_task',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => 'R',
        'month' => '*'
    ),
);
