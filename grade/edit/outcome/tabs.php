<?php
//

/**
 * Prints navigation tabs for viewing and editing grade outcomes
 *
 * @package   core_grades
 * @copyright 2009 Petr Skoda
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

    $row = $tabs = array();

    $context = context_course::instance($courseid);

    $row[] = new tabobject('courseoutcomes',
                           $CFG->wwwroot.'/grade/edit/outcome/course.php?id='.$courseid,
                           get_string('outcomescourse', 'grades'));

    if (has_capability('moodle/grade:manage', $context)) {
        $row[] = new tabobject('outcomes',
                               $CFG->wwwroot.'/grade/edit/outcome/index.php?id='.$courseid,
                               get_string('editoutcomes', 'grades'));
    }

    $tabs[] = $row;

    echo '<div class="outcomedisplay">';
    print_tabs($tabs, $currenttab);
    echo '</div>';


