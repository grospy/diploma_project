<?php
//

/**
 * IMSCP export lib
 *
 * @package    booktool_exportimscp
 * @copyright  2011 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Adds module specific settings to the settings block
 *
 * @param settings_navigation $settings The settings navigation object
 * @param navigation_node $node The node to add module settings to
 */
function booktool_exportimscp_extend_settings_navigation(settings_navigation $settings, navigation_node $node) {
    global $PAGE;

    if (has_capability('booktool/exportimscp:export', $PAGE->cm->context)) {
        $url = new moodle_url('/mod/book/tool/exportimscp/index.php', array('id'=>$PAGE->cm->id));
        $icon = new pix_icon('generate', '', 'booktool_exportimscp', array('class'=>'icon'));
        $node->add(get_string('generateimscp', 'booktool_exportimscp'), $url, navigation_node::TYPE_SETTING, null, null, $icon);
    }
}
