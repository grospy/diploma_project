<?php
//

/**
 * URL resolver.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp;
defined('MOODLE_INTERNAL') || die();

use moodle_url;

/**
 * URL resolver class.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class url_resolver {

    /**
     * The URL where the competency can be found.
     *
     * @param int $competencyid The competency ID.
     * @param int $pagecontextid The ID of the context we are in.
     * @return moodle_url
     */
    public function competency($competencyid, $pagecontextid) {
        return new moodle_url('/admin/tool/lp/editcompetency.php', array(
            'id' => $competencyid,
            'pagecontextid' => $pagecontextid
        ));
    }

    /**
     * The URL where the framework can be found.
     *
     * @param int $frameworkid The framework ID.
     * @param int $pagecontextid The ID of the context we are in.
     * @return moodle_url
     */
    public function framework($frameworkid, $pagecontextid) {
        return new moodle_url('/admin/tool/lp/competencies.php', array(
            'competencyframeworkid' => $frameworkid,
            'pagecontextid' => $pagecontextid
        ));
    }

    /**
     * The URL where the frameworks can be found.
     *
     * @param int $pagecontextid The ID of the context that we are browsing.
     * @return moodle_url
     */
    public function frameworks($pagecontextid) {
        return new moodle_url('/admin/tool/lp/competencyframeworks.php', array('pagecontextid' => $pagecontextid));
    }

    /**
     * The URL where the plan can be found.
     *
     * @param int $planid The plan ID.
     * @return moodle_url
     */
    public function plan($planid) {
        return new moodle_url('/admin/tool/lp/plan.php', array('id' => $planid));
    }

    /**
     * The URL where the plans of a user can be found.
     *
     * @param int $userid The user ID.
     * @return moodle_url
     */
    public function plans($userid) {
        return new moodle_url('/admin/tool/lp/plans.php', array('userid' => $userid));
    }

    /**
     * The URL where the template can be found.
     *
     * @param int $templateid The template ID.
     * @param int $pagecontextid The ID of the context we are in.
     * @return moodle_url
     */
    public function template($templateid, $pagecontextid) {
        return new moodle_url('/admin/tool/lp/templatecompetencies.php', array(
            'templateid' => $templateid,
            'pagecontextid' => $pagecontextid
        ));
    }

    /**
     * The URL where the templates can be found.
     *
     * @param int $pagecontextid The ID of the context that we are browsing.
     * @return moodle_url
     */
    public function templates($pagecontextid) {
        return new moodle_url('/admin/tool/lp/learningplans.php', array('pagecontextid' => $pagecontextid));
    }

    /**
     * The URL where the user competency can be found.
     *
     * @param int $usercompetencyid The user competency ID
     * @return moodle_url
     */
    public function user_competency($usercompetencyid) {
        return new moodle_url('/admin/tool/lp/user_competency.php', array('id' => $usercompetencyid));
    }

    /**
     * The URL where the user competency can be found in the context of a course.
     *
     * @param int $userid The user ID
     * @param int $competencyid The competency ID.
     * @param int $courseid The course ID.
     * @return moodle_url
     */
    public function user_competency_in_course($userid, $competencyid, $courseid) {
        return new moodle_url('/admin/tool/lp/user_competency_in_course.php', array(
            'userid' => $userid,
            'competencyid' => $competencyid,
            'courseid' => $courseid
        ));
    }

    /**
     * The URL where the user competency can be found in the context of a plan.
     *
     * @param int $userid The user ID
     * @param int $competencyid The competency ID.
     * @param int $planid The plan ID.
     * @return moodle_url
     */
    public function user_competency_in_plan($userid, $competencyid, $planid) {
        return new moodle_url('/admin/tool/lp/user_competency_in_plan.php', array(
            'userid' => $userid,
            'competencyid' => $competencyid,
            'planid' => $planid
        ));
    }

    /**
     * The URL where the user evidence (of prior learning) can be found.
     *
     * @param int $userevidenceid The user evidence ID
     * @return moodle_url
     */
    public function user_evidence($userevidenceid) {
        return new moodle_url('/admin/tool/lp/user_evidence.php', array('id' => $userevidenceid));
    }

}
