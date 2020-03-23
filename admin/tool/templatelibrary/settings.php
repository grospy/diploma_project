<?php
//

/**
 * Links and settings
 *
 * This file contains links and settings used by tool_templatelibrary
 *
 * @package    tool_templatelibrary
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;
// Template library page.
$temp = new admin_externalpage(
    'tooltemplatelibrary',
    get_string('pluginname', 'tool_templatelibrary'),
    new moodle_url('/admin/tool/templatelibrary/index.php')
);
$ADMIN->add('development', $temp);
