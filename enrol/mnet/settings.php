<?php
//

/**
 * Cohort enrolment plugin settings and default values
 *
 * @package    enrol_mnet
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_mnet_settings', '', get_string('pluginname_desc', 'enrol_mnet')));

    //--- enrol instance defaults ----------------------------------------------------------------------------
    if (!during_initial_install()) {
        $options = get_default_enrol_roles(context_system::instance());
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect_with_advanced('enrol_mnet/roleid',
            get_string('defaultrole', 'role'), '',
            array('value'=>$student->id, 'adv'=>true), $options));
    }
}
