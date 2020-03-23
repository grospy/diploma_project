<?php
//

/**
 * User grade report external functions and service definitions.
 *
 * @package    gradereport_user
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(

    'gradereport_user_get_grades_table' => array(
        'classname' => 'gradereport_user_external',
        'methodname' => 'get_grades_table',
        'classpath' => 'grade/report/user/externallib.php',
        'description' => 'Get the user/s report grades table for a course',
        'type' => 'read',
        'capabilities' => 'gradereport/user:view',
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'gradereport_user_view_grade_report' => array(
        'classname' => 'gradereport_user_external',
        'methodname' => 'view_grade_report',
        'classpath' => 'grade/report/user/externallib.php',
        'description' => 'Trigger the report view event',
        'type' => 'write',
        'capabilities' => 'gradereport/user:view',
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'gradereport_user_get_grade_items' => array(
        'classname' => 'gradereport_user_external',
        'methodname' => 'get_grade_items',
        'classpath' => 'grade/report/user/externallib.php',
        'description' => 'Returns the complete list of grade items for users in a course',
        'type' => 'read',
        'capabilities' => 'gradereport/user:view',
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    )
);
