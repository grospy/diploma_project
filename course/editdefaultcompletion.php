<?php
//

/**
 * Bulk activity completion selection
 *
 * @package     core_completion
 * @copyright   2017 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . "/../config.php");
require_once($CFG->libdir . '/completionlib.php');

$courseid = required_param('id', PARAM_INT);
$modids = optional_param_array('modids', [], PARAM_INT);
$course = get_course($courseid);
require_login($course);

navigation_node::override_active_url(new moodle_url('/course/completion.php', array('id' => $course->id)));
$PAGE->set_url(new moodle_url('/course/editdefaultcompletion.php', ['id' => $courseid]));
$PAGE->set_title($course->shortname);
$PAGE->set_heading($course->fullname);
$PAGE->set_pagelayout('admin');

require_capability('moodle/course:manageactivities', context_course::instance($course->id));

// Prepare list of selected modules.
$manager = new \core_completion\manager($course->id);
$allmodules = $manager->get_activities_and_resources();
$modules = [];
foreach ($allmodules->modules as $module) {
    if ($module->canmanage && in_array($module->id, $modids)) {
        $modules[$module->id] = $module;
    }
}

$returnurl = new moodle_url('/course/defaultcompletion.php', ['id' => $course->id]);
if (empty($modules)) {
    redirect($returnurl);
}

$form = new core_completion_defaultedit_form(null, ['course' => $course, 'modules' => $modules]);

if ($form->is_cancelled()) {
    redirect($returnurl);
} else if ($data = $form->get_data()) {
    $manager->apply_default_completion($data, $form->has_custom_completion_rules());
    redirect($returnurl);
}

$renderer = $PAGE->get_renderer('core_course', 'bulk_activity_completion');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('defaultcompletion', 'completion'));

echo $renderer->navigation($course, 'defaultcompletion');

echo $renderer->edit_default_completion($form, $modules);

echo $OUTPUT->footer();

