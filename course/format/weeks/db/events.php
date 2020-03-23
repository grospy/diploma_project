<?php
//

/**
 * Format weeks event handler definition.
 *
 * @package format_weeks
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname'   => '\core\event\course_updated',
        'callback'    => 'format_weeks_observer::course_updated',
    ),
    array(
        'eventname'   => '\core\event\course_section_created',
        'callback'    => 'format_weeks_observer::course_section_created',
    ),
    array(
        'eventname'   => '\core\event\course_section_deleted',
        'callback'    => 'format_weeks_observer::course_section_deleted',
    )
);
