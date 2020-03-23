<?php
//

/**
 * Settings for unoconv.
 *
 * @package   fileconverter_unoconv
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Unoconv setting.
$settings->add(new admin_setting_configexecutable('pathtounoconv',
        new lang_string('pathtounoconv', 'fileconverter_unoconv'),
        new lang_string('pathtounoconv_help', 'fileconverter_unoconv'),
        '/usr/bin/unoconv')
    );

$url = new moodle_url('/files/converter/unoconv/testunoconv.php');
$link = html_writer::link($url, get_string('test_unoconv', 'fileconverter_unoconv'));
$settings->add(new admin_setting_heading('test_unoconv', '', $link));
