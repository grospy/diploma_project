<?php
//

/**
 * Outputs navigation tabs for the grader report
 *
 * @package   gradereport_grader
 * @copyright 2007 2009 Nicolas Connault
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

    $row = $tabs = array();
    $tabcontext = context_course::instance($COURSE->id);
    $row[] = new tabobject('graderreport',
                           $CFG->wwwroot.'/grade/report/grader/index.php?id='.$courseid,
                           get_string('pluginname', 'gradereport_grader'));
    if (has_capability('moodle/grade:manage',$tabcontext ) ||
        has_capability('moodle/grade:edit', $tabcontext) ||
        has_capability('gradereport/grader:view', $tabcontext)) {
        $row[] = new tabobject('preferences',
                               $CFG->wwwroot.'/grade/report/grader/preferences.php?id='.$courseid,
                               get_string('myreportpreferences', 'grades'));
    }

    $tabs[] = $row;
    echo '<div class="gradedisplay">';
    print_tabs($tabs, $currenttab);
    echo '</div>';

