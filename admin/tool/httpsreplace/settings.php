<?php
//

/**
 * Link to http -> https replace script.
 *
 * @package tool_httpsreplace
 * @copyright Copyright (c) 2016 Blackboard Inc. (http://www.blackboard.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    $pluginname = get_string('pluginname', 'tool_httpsreplace');
    $url = $CFG->wwwroot.'/'.$CFG->admin.'/tool/httpsreplace/index.php';
    $ADMIN->add('security', new admin_externalpage('toolhttpsreplace', $pluginname, $url, 'moodle/site:config', true));

    $httpsreplaceurl = $CFG->wwwroot.'/'.$CFG->admin.'/tool/httpsreplace/index.php';
    $ADMIN->locate('httpsecurity')->add(
        new admin_setting_heading(
            'tool_httpsreplaceheader',
            new lang_string('pluginname', 'tool_httpsreplace'),
            new lang_string('toolintro', 'tool_httpsreplace', $httpsreplaceurl)
        )
    );
}
