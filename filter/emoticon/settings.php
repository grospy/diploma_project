<?php

//

/**
 * @package    filter
 * @subpackage emoticon
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configmulticheckbox('filter_emoticon/formats',
            get_string('settingformats', 'filter_emoticon'),
            get_string('settingformats_desc', 'filter_emoticon'),
            array(FORMAT_HTML => 1, FORMAT_MARKDOWN => 1, FORMAT_MOODLE => 1), format_text_menu()));
}
