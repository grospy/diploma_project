<?php
//

/**
 * Link to the OAuth 2 service we will use.
 *
 * @package   fileconverter_googledrive
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $options = [];
    $issuers = \core\oauth2\api::get_all_issuers();

    $options[''] = get_string('disabled', 'fileconverter_googledrive');
    foreach ($issuers as $issuer) {
        $options[$issuer->get('id')] = s($issuer->get('name'));
    }

    $settings->add(new admin_setting_configselect('fileconverter_googledrive/issuerid',
                                                  get_string('issuer', 'fileconverter_googledrive'),
                                                  get_string('issuer_help', 'fileconverter_googledrive'),
                                                  '',
                                                  $options));

    $url = new moodle_url('/files/converter/googledrive/test.php');
    $link = html_writer::link($url, get_string('test_converter', 'fileconverter_googledrive'));
    $settings->add(new admin_setting_heading('test_converter', '', $link));
}
