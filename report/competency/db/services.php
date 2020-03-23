<?php
//


/**
 * Competency report webservice functions
 *
 *
 * @package    report_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(

    // Learning plan related functions.

    'report_competency_data_for_report' => array(
        'classname'    => 'report_competency\external',
        'methodname'   => 'data_for_report',
        'classpath'    => '',
        'description'  => 'Load the data for the competency report in a course.',
        'type'         => 'read',
        'capabilities' => 'moodle/competency:coursecompetencyview',
        'ajax'         => true,
    )
);

