<?php
//

/**
 * This file defines tasks performed by the plugin.
 *
 * @package    mod_lti
 * @copyright  2019 Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// List of tasks.
$tasks = array(
    array(
        'classname' => 'mod_lti\task\clean_access_tokens',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    )
);
