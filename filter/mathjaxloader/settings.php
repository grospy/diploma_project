<?php
//

/**
 * MathJAX filter settings
 *
 * @package    filter_mathjaxloader
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $item = new admin_setting_heading('filter_mathjaxloader/localinstall',
                                      new lang_string('localinstall', 'filter_mathjaxloader'),
                                      new lang_string('localinstall_help', 'filter_mathjaxloader'));
    $settings->add($item);

    $item = new admin_setting_configtext('filter_mathjaxloader/httpsurl',
                                         new lang_string('httpsurl', 'filter_mathjaxloader'),
                                         new lang_string('httpsurl_help', 'filter_mathjaxloader'),
                                         'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js',
                                         PARAM_RAW);
    $settings->add($item);

    $item = new admin_setting_configcheckbox('filter_mathjaxloader/texfiltercompatibility',
                                             new lang_string('texfiltercompatibility', 'filter_mathjaxloader'),
                                             new lang_string('texfiltercompatibility_help', 'filter_mathjaxloader'),
                                             0);
    $settings->add($item);

    $default = '
MathJax.Hub.Config({
    config: ["Accessible.js", "Safe.js"],
    errorSettings: { message: ["!"] },
    skipStartupTypeset: true,
    messageStyle: "none"
});
';

    $item = new admin_setting_configtextarea('filter_mathjaxloader/mathjaxconfig',
                                             new lang_string('mathjaxsettings','filter_mathjaxloader'),
                                             new lang_string('mathjaxsettings_desc', 'filter_mathjaxloader'),
                                             $default);

    $settings->add($item);

    $item = new admin_setting_configtext('filter_mathjaxloader/additionaldelimiters',
                                         new lang_string('additionaldelimiters', 'filter_mathjaxloader'),
                                         new lang_string('additionaldelimiters_help', 'filter_mathjaxloader'),
                                         '',
                                         PARAM_RAW);
    $settings->add($item);

}