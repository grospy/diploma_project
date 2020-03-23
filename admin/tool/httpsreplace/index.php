<?php
//

/**
 * Search and replace http -> https throughout all texts in the whole database
 *
 * @package    tool_httpsreplace
 * @copyright Copyright (c) 2016 Blackboard Inc. (http://www.blackboard.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

admin_externalpage_setup('toolhttpsreplace');

$context = context_system::instance();

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/admin/tool/httpsreplace/index.php'));
$PAGE->set_title(get_string('pageheader', 'tool_httpsreplace'));
$PAGE->set_pagelayout('admin');

echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('pageheader', 'tool_httpsreplace'));

if (!$DB->replace_all_text_supported()) {
    echo $OUTPUT->notification(get_string('notimplemented', 'tool_httpsreplace'));
    echo $OUTPUT->footer();
    die;
}

if (!is_https()) {
    echo $OUTPUT->notification(get_string('httpwarning', 'tool_httpsreplace'), 'warning');
}

echo '<p>'.get_string('domainexplain', 'tool_httpsreplace').'</p>';
echo '<p>'.page_doc_link(get_string('doclink', 'tool_httpsreplace')).'</p>';

echo $OUTPUT->continue_button(new moodle_url('/admin/tool/httpsreplace/tool.php'));

echo $OUTPUT->footer();
