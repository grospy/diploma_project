<?php
//

/**
 * File.
 *
 * @package    core_competency
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Save processing when the user will not be able to access anything.
if (has_capability('moodle/site:config', $systemcontext)) {

    $parentname = 'competencies';

    // Settings page.
    $settings = new admin_settingpage('competencysettings', new lang_string('competenciessettings', 'core_competency'),
        'moodle/site:config', false);
    $ADMIN->add($parentname, $settings);

    // Load the full tree of settings.
    if ($ADMIN->fulltree) {
        $setting = new admin_setting_configcheckbox('core_competency/enabled',
            new lang_string('enablecompetencies', 'core_competency'),
            new lang_string('enablecompetencies_desc', 'core_competency'), 1);
        $settings->add($setting);

        $setting = new admin_setting_configcheckbox('core_competency/pushcourseratingstouserplans',
            new lang_string('pushcourseratingstouserplans', 'core_competency'),
            new lang_string('pushcourseratingstouserplans_desc', 'core_competency'), 1);
        $settings->add($setting);
    }

}
