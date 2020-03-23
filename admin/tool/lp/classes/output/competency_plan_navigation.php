<?php
//

/**
 * User competency plan page class.
 *
 * @package    tool_lp
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\output;

use renderable;
use renderer_base;
use templatable;
use context_course;
use core_competency\external\competency_exporter;
use core_competency\external\performance_helper;
use stdClass;

/**
 * User competency plan navigation class.
 *
 * @package    tool_lp
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_plan_navigation implements renderable, templatable {

    /** @var userid */
    protected $userid;

    /** @var competencyid */
    protected $competencyid;

    /** @var planid */
    protected $planid;

    /** @var baseurl */
    protected $baseurl;

    /**
     * Construct.
     *
     * @param int $userid
     * @param int $competencyid
     * @param int $planid
     * @param string $baseurl
     */
    public function __construct($userid, $competencyid, $planid, $baseurl) {
        $this->userid = $userid;
        $this->competencyid = $competencyid;
        $this->planid = $planid;
        $this->baseurl = $baseurl;
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {

        $data = new stdClass();
        $data->userid = $this->userid;
        $data->competencyid = $this->competencyid;
        $data->planid = $this->planid;
        $data->baseurl = $this->baseurl;

        $plancompetencies = \core_competency\api::list_plan_competencies($data->planid);
        $data->competencies = array();
        $helper = new performance_helper();
        foreach ($plancompetencies as $plancompetency) {
            $context = $helper->get_context_from_competency($plancompetency->competency);
            $exporter = new competency_exporter($plancompetency->competency, array('context' => $context));
            $competency = $exporter->export($output);
            if ($competency->id == $this->competencyid) {
                $competency->selected = true;
            }
            $data->competencies[] = $competency;
        }
        $data->hascompetencies = count($data->competencies);
        return $data;
    }
}
