<?php
//

/**
 * This page lets users to manage site wide learning plan templates.
 *
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

$id = optional_param('id', 0, PARAM_INT);
$returntype = optional_param('return', null, PARAM_ALPHA);
$pagecontextid = required_param('pagecontextid', PARAM_INT);  // Reference to where we can from.

$template = null;
if (!empty($id)) {
    // Always use the context from the framework when it exists.
    $template = new \core_competency\template($id);
    $context = $template->get_context();
} else {
    $context = context::instance_by_id($pagecontextid);
}

// We check that we have the permission to edit this framework, in its own context.
require_login(0, false);
\core_competency\api::require_enabled();
require_capability('moodle/competency:templatemanage', $context);

// We keep the original context in the URLs, so that we remain in the same context.
$url = new moodle_url("/admin/tool/lp/edittemplate.php", [
    'id' => $id,
    'pagecontextid' => $pagecontextid,
    'return' => $returntype
]);

if (empty($id)) {
    $pagetitle = get_string('addnewtemplate', 'tool_lp');
    list($title, $subtitle, $returnurl) = \tool_lp\page_helper::setup_for_template($pagecontextid, $url, null, $pagetitle,
        $returntype);
} else {
    $template = \core_competency\api::read_template($id);
    $pagetitle = get_string('edittemplate', 'tool_lp');
    list($title, $subtitle, $returnurl) = \tool_lp\page_helper::setup_for_template($pagecontextid, $url, $template,
        $pagetitle, $returntype);
}

$form = new \tool_lp\form\template($url->out(false), array('persistent' => $template, 'context' => $context));
if ($form->is_cancelled()) {
    redirect($returnurl);
}

$data = $form->get_data();
if ($data) {
    if (empty($data->id)) {
        $template = \core_competency\api::create_template($data);
        $returnurl = new moodle_url('/admin/tool/lp/templatecompetencies.php', [
            'templateid' => $template->get('id'),
            'pagecontextid' => $pagecontextid
        ]);
        $returnmsg = get_string('templatecreated', 'tool_lp');
    } else {
        \core_competency\api::update_template($data);
        $returnmsg = get_string('templateupdated', 'tool_lp');
    }
    redirect($returnurl, $returnmsg, null, \core\output\notification::NOTIFY_SUCCESS);
}

$output = $PAGE->get_renderer('tool_lp');
echo $output->header();
echo $output->heading($title);
if (!empty($subtitle)) {
    echo $output->heading($subtitle, 3);
}

$form->display();

echo $output->footer();
