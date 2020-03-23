<?php
//

/**
 * This page lets users manage categories.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

require_login(null, false);

$id = optional_param('id', 0, PARAM_INT);

$url = new \moodle_url('/admin/tool/dataprivacy/editcategory.php', array('id' => $id));
if ($id) {
    $title = get_string('editcategory', 'tool_dataprivacy');
} else {
    $title = get_string('addcategory', 'tool_dataprivacy');
}
\tool_dataprivacy\page_helper::setup($url, $title, 'dataregistry');

$category = new \tool_dataprivacy\category($id);
$form = new \tool_dataprivacy\form\category($PAGE->url->out(false),
    array('persistent' => $category, 'showbuttons' => true));

$returnurl = new \moodle_url('/admin/tool/dataprivacy/categories.php');
if ($form->is_cancelled()) {
    redirect($returnurl);
} else if ($data = $form->get_data()) {
    if (empty($data->id)) {
        \tool_dataprivacy\api::create_category($data);
        $messagesuccess = get_string('categorycreated', 'tool_dataprivacy');
    } else {
        \tool_dataprivacy\api::update_category($data);
        $messagesuccess = get_string('categoryupdated', 'tool_dataprivacy');
    }
    redirect($returnurl, $messagesuccess, 0, \core\output\notification::NOTIFY_SUCCESS);
}

$output = $PAGE->get_renderer('tool_dataprivacy');
echo $output->header();
$form->display();
echo $output->footer();
