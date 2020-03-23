<?php
//

/**
 * Guest enrolment method external API
 *
 * @package    enrol_guest
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.1
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/externallib.php');
require_once($CFG->libdir . '/enrollib.php');

/**
 * Guest enrolment method external API
 *
 * @package    enrol_guest
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.1
 */
class enrol_guest_external extends external_api {

    /**
     * Returns description of get_instance_info() parameters.
     *
     * @return external_function_parameters
     * @since Moodle 3.1
     */
    public static function get_instance_info_parameters() {
        return new external_function_parameters(
                array('instanceid' => new external_value(PARAM_INT, 'Instance id of guest enrolment plugin.'))
            );
    }

    /**
     * Return guest enrolment instance information.
     *
     * @param int $instanceid instance id of guest enrolment plugin.
     * @return array warnings and instance information.
     * @since Moodle 3.1
     */
    public static function get_instance_info($instanceid) {
        global $DB;

        $params = self::validate_parameters(self::get_instance_info_parameters(), array('instanceid' => $instanceid));
        $warnings = array();

        // Retrieve guest enrolment plugin.
        $enrolplugin = enrol_get_plugin('guest');
        if (empty($enrolplugin)) {
            throw new moodle_exception('invaliddata', 'error');
        }

        self::validate_context(context_system::instance());
        $enrolinstance = $DB->get_record('enrol', array('id' => $params['instanceid']), '*', MUST_EXIST);

        $course = $DB->get_record('course', array('id' => $enrolinstance->courseid), '*', MUST_EXIST);
        if (!core_course_category::can_view_course_info($course) && !can_access_course($course)) {
            throw new moodle_exception('coursehidden');
        }

        $instanceinfo = $enrolplugin->get_enrol_info($enrolinstance);
        // Specific instance information.
        $instanceinfo->passwordrequired = $instanceinfo->requiredparam->passwordrequired;

        unset($instanceinfo->requiredparam);

        $result = array();
        $result['instanceinfo'] = $instanceinfo;
        $result['warnings'] = $warnings;
        return $result;
    }

    /**
     * Returns description of get_instance_info() result value.
     *
     * @return external_description
     * @since Moodle 3.1
     */
    public static function get_instance_info_returns() {
        return new external_single_structure(
            array(
                'instanceinfo' => new external_single_structure(
                    array(
                        'id' => new external_value(PARAM_INT, 'Id of course enrolment instance'),
                        'courseid' => new external_value(PARAM_INT, 'Id of course'),
                        'type' => new external_value(PARAM_PLUGIN, 'Type of enrolment plugin'),
                        'name' => new external_value(PARAM_RAW, 'Name of enrolment plugin'),
                        'status' => new external_value(PARAM_BOOL, 'Is the enrolment enabled?'),
                        'passwordrequired' => new external_value(PARAM_BOOL, 'Is a password required?'),
                    )
                ),
                'warnings' => new external_warnings()
            )
        );
    }

}
