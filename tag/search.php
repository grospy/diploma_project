<?php
//

/**
 * @package    core
 * @subpackage tag
 * @copyright  2007 Luiz Cruz <luiz.laydner@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');

require_login();

if (empty($CFG->usetags)) {
    print_error('tagsaredisabled', 'tag');
}

$query     = optional_param('query', '', PARAM_RAW);
$tagcollid = optional_param('tc', 0, PARAM_INT);
$edit      = optional_param('edit', -1, PARAM_BOOL);

$params = array();
if ($query !== '') {
    $params['query'] = $query;
}
if ($tagcollid) {
    $params['tc'] = $tagcollid;
}

$PAGE->set_url(new moodle_url('/tag/search.php', $params));
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');

$PAGE->set_title(get_string('tags', 'tag'));
$PAGE->set_heading($SITE->fullname);

$buttons = '';
if (has_capability('moodle/tag:manage', context_system::instance())) {
    $buttons .= $OUTPUT->single_button(new moodle_url('/tag/manage.php'),
            get_string('managetags', 'tag'), 'GET');
}
if ($PAGE->user_allowed_editing()) {
    if ($edit != -1) {
        $USER->editing = $edit;
    }
    $buttons .= $OUTPUT->edit_button(clone($PAGE->url));
}
$PAGE->set_button($buttons);

$tagrenderer = $PAGE->get_renderer('core', 'tag');
$pagecontents = $tagrenderer->tag_search_page($query, $tagcollid);

echo $OUTPUT->header();
echo $pagecontents;
echo $OUTPUT->footer();
