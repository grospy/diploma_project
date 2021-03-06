<?php
//

/**
 * This file contains mappings for classes that have been renamed so that they meet the requirements of the autoloader.
 *
 * Renaming isn't always the recommended approach, but can provide benefit in situations where we've already got a
 * close structure, OR where lots of classes get included and not necessarily used, or checked for often.
 *
 * When renaming a class delete the original class and add an entry to the db/renamedclasses.php directory for that
 * component.
 * This way we don't need to keep around old classes, instead creating aliases only when required.
 * One big advantage to this method is that we provide consistent debugging for renamed classes when they are used.
 *
 * @package    core
 * @copyright  2014 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Like other files in the db directory this file uses an array.
// The old class name is the key, the new class name is the value.
// The array must be called $renamedclasses.
$renamedclasses = array(
    'course_in_list' => 'core_course_list_element',
    'coursecat' => 'core_course_category',
    'core\\analytics\\target\\course_dropout' => 'core_course\\analytics\\target\\course_dropout',
    'core\\analytics\\target\\course_competencies' => 'core_course\\analytics\\target\\course_competencies',
    'core\\analytics\\target\\course_completion' => 'core_course\\analytics\\target\\course_completion',
    'core\\analytics\\target\\course_gradetopass' => 'core_course\\analytics\\target\\course_gradetopass',
    'core\\analytics\\target\\no_teaching' => 'core_course\\analytics\\target\\no_teaching',
);
