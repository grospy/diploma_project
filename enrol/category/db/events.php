<?php
//

/**
 * Category enrolment plugin event handler definition.
 *
 * @package   enrol_category
 * @category  event
 * @copyright 2010 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array (

    array (
        'eventname' => '\core\event\role_assigned',
        'callback'  => 'enrol_category_observer::role_assigned',
    ),

    array (
        'eventname' => '\core\event\role_unassigned',
        'callback'  => 'enrol_category_observer::role_unassigned',
    ),

);
