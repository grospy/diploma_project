<?php
//

/**
 * Category enrolment plugin settings and presets.
 *
 * @package    enrol_category
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_category_settings', '', get_string('pluginname_desc', 'enrol_category')));


    //--- enrol instance defaults ----------------------------------------------------------------------------

}
