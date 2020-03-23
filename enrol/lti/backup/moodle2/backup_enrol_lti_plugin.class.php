<?php
//

/**
 * Defines the backup_enrol_lti_plugin class.
 *
 * @package   enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Define all the backup steps.
 *
 * @package   enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_enrol_lti_plugin extends backup_enrol_plugin {

    /**
     * Defines the other LTI enrolment structures to append.
     *
     * @return backup_plugin_element
     */
    public function define_enrol_plugin_structure() {
        // Get the parent we will be adding these elements to.
        $plugin = $this->get_plugin_element();

        // Define our elements.
        $tool = new backup_nested_element('tool', array('id'), array(
            'enrolid', 'contextid', 'institution', 'lang', 'timezone', 'maxenrolled', 'maildisplay', 'city',
            'country', 'gradesync', 'gradesynccompletion', 'membersync', 'membersyncmode',  'roleinstructor',
            'rolelearner', 'secret', 'timecreated', 'timemodified'));

        $users = new backup_nested_element('users');

        $user = new backup_nested_element('user', array('id'), array(
            'userid', 'toolid', 'serviceurl', 'sourceid', 'consumerkey', 'consumersecret', 'membershipurl',
            'membershipsid'));

        // Build elements hierarchy.
        $plugin->add_child($tool);
        $tool->add_child($users);
        $users->add_child($user);

        // Set sources to populate the data.
        $tool->set_source_table('enrol_lti_tools',
            array('enrolid' => backup::VAR_PARENTID));

        // Users are only added only if users included.
        if ($this->task->get_setting_value('users')) {
            $user->set_source_table('enrol_lti_users', array('toolid' => backup::VAR_PARENTID));
        }
    }
}
