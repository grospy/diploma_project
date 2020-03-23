<?php
//

/**
 * Airnotifier configuration page
 *
 * @package    message_airnotifier
 * @copyright  2012 Jerome Mouneyrac, 2014 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // The processor should be enabled by the same enable mobile setting.
    $settings->add(new admin_setting_configtext('airnotifierurl',
                    get_string('airnotifierurl', 'message_airnotifier'),
                    get_string('configairnotifierurl', 'message_airnotifier'), 'https://messages.moodle.net', PARAM_URL));
    $settings->add(new admin_setting_configtext('airnotifierport',
                    get_string('airnotifierport', 'message_airnotifier'),
                    get_string('configairnotifierport', 'message_airnotifier'), 443, PARAM_INT));
    $settings->add(new admin_setting_configtext('airnotifiermobileappname',
                    get_string('airnotifiermobileappname', 'message_airnotifier'),
                    get_string('configairnotifiermobileappname', 'message_airnotifier'), 'com.moodle.moodlemobile', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('airnotifierappname',
                    get_string('airnotifierappname', 'message_airnotifier'),
                    get_string('configairnotifierappname', 'message_airnotifier'), 'commoodlemoodlemobile', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('airnotifieraccesskey',
                    get_string('airnotifieraccesskey', 'message_airnotifier'),
                    get_string('configairnotifieraccesskey', 'message_airnotifier'), '', PARAM_ALPHANUMEXT));

    $url = new moodle_url('/message/output/airnotifier/requestaccesskey.php', array('sesskey' => sesskey()));
    $link = html_writer::link($url, get_string('requestaccesskey', 'message_airnotifier'));
    $settings->add(new admin_setting_heading('requestaccesskey', '', $link));
}
