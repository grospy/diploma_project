<?php
//

/**
 * External functions and service definitions for the Marking Guide advanced grading form.
 *
 * @package    gradingform_guide
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    'gradingform_guide_grader_gradingpanel_fetch' => [
        'classname' => 'gradingform_guide\\grades\\grader\\gradingpanel\\external\\fetch',
        'methodname' => 'execute',
        'description' => 'Fetch the data required to display the grader grading panel, ' .
            'creating the grade item if required',
        'type' => 'write',
        'ajax' => true,
    ],
    'gradingform_guide_grader_gradingpanel_store' => [
        'classname' => 'gradingform_guide\\grades\\grader\\gradingpanel\\external\\store',
        'methodname' => 'execute',
        'description' => 'Store the grading data for a user from the grader grading panel.',
        'type' => 'write',
        'ajax' => true,
    ],
];
