<?php
//

/**
 * Rubric external functions and service definitions.
 *
 * @package    gradingform_rubric
 * @copyright  2019 Mathew May <mathew.solutions>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    'gradingform_rubric_grader_gradingpanel_fetch' => [
        'classname' => 'gradingform_rubric\\grades\\grader\\gradingpanel\\external\\fetch',
        'methodname' => 'execute',
        'description' => 'Fetch the data required to display the grader grading panel, ' .
            'creating the grade item if required',
        'type' => 'write',
        'ajax' => true,
    ],
    'gradingform_rubric_grader_gradingpanel_store' => [
        'classname' => 'gradingform_rubric\\grades\\grader\\gradingpanel\\external\\store',
        'methodname' => 'execute',
        'description' => 'Store the grading data for a user from the grader grading panel.',
        'type' => 'write',
        'ajax' => true,
    ],
];


