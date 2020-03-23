<?php

//

/**
 * @package    plugintype
 * @subpackage pluginname
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configmulticheckbox('filter_urltolink/formats',
            get_string('settingformats', 'filter_urltolink'),
            get_string('settingformats_desc', 'filter_urltolink'),
            array(FORMAT_MOODLE => 1), format_text_menu()));

    $settings->add(new admin_setting_configcheckbox('filter_urltolink/embedimages',
            get_string('embedimages', 'filter_urltolink'),
            get_string('embedimages_desc', 'filter_urltolink'),
            1));
}
