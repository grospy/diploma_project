<?php
//

/**
 * Public API of the competency report.
 *
 * Defines the APIs used by competency reports
 *
 * @package    report_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * This function extends the navigation with the report items
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the report
 * @param stdClass $context The context of the course
 */
function report_competency_extend_navigation_course($navigation, $course, $context) {
    if (!get_config('core_competency', 'enabled')) {
        return;
    }

    if (has_capability('moodle/competency:coursecompetencyview', $context)) {
        $url = new moodle_url('/report/competency/index.php', array('id' => $course->id));
        $name = get_string('pluginname', 'report_competency');
        $navigation->add($name, $url, navigation_node::TYPE_SETTING, null, null, new pix_icon('i/report', ''));
    }
}

/**
 * This function extends the navigation with the report items
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param cminfo $cm The course module.
 */
function report_competency_extend_navigation_module($navigation, $cm) {
    if (!get_config('core_competency', 'enabled')) {
        return;
    }

    if (has_any_capability(array('moodle/competency:usercompetencyview', 'moodle/competency:coursecompetencymanage'),
            context_course::instance($cm->course))) {
        $url = new moodle_url('/report/competency/index.php', array('id' => $cm->course, 'mod' => $cm->id));
        $name = get_string('pluginname', 'report_competency');
        $navigation->add($name, $url, navigation_node::TYPE_SETTING, null, null);
    }
}
