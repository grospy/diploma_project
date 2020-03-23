<?php
//

/**
 * Overview grade report external functions and service definitions.
 *
 * @package    gradereport_overview
 * @copyright  2016 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(

    'gradereport_overview_get_course_grades' => array(
        'classname' => 'gradereport_overview_external',
        'methodname' => 'get_course_grades',
        'description' => 'Get the given user courses final grades',
        'type' => 'read',
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'gradereport_overview_view_grade_report' => array(
        'classname' => 'gradereport_overview_external',
        'methodname' => 'view_grade_report',
        'description' => 'Trigger the report view event',
        'type' => 'write',
        'capabilities' => 'gradereport/overview:view',
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    )
);
