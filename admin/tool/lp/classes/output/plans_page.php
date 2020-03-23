<?php
//

/**
 * Class containing data for a user learning plans list page.
 *
 * @package    tool_lp
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use stdClass;
use single_button;
use moodle_url;
use core_competency\api;
use core_competency\external\plan_exporter;
use core_competency\plan;
use core_competency\user_evidence;
use context_user;

/**
 * Class containing data for a user learning plans list page.
 *
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plans_page implements renderable, templatable {

    /** @var array $navigation List of links to display on the page. Each link contains a url and a title. */
    protected $navigation = array();

    /** @var array|\core_competency\plan[] $plans List of plans. */
    protected $plans = array();

    /** @var context_user|null $context context.  */
    protected $context = null;

    /** @var int|null $userid Userid. */
    protected $userid = null;

    /**
     * Construct this renderable.
     *
     * @param int $userid
     */
    public function __construct($userid) {
        $this->userid = $userid;
        $this->plans = api::list_user_plans($userid);
        $this->context = context_user::instance($userid);

        if (plan::can_manage_user($userid) || plan::can_manage_user_draft($userid)) {
            $addplan = new single_button(
                new moodle_url('/admin/tool/lp/editplan.php', array('userid' => $userid)),
                get_string('addnewplan', 'tool_lp'), 'get'
            );
            $this->navigation[] = $addplan;
        }
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->userid = $this->userid;
        $data->pluginbaseurl = (new moodle_url('/admin/tool/lp'))->out(true);
        $data->canreaduserevidence = user_evidence::can_read_user($this->userid);
        $data->canmanageuserplans = plan::can_manage_user($this->userid);

        // Attach standard objects as mustache can not parse \core_competency\plan objects.
        $data->plans = array();
        if ($this->plans) {
            foreach ($this->plans as $plan) {
                $exporter = new plan_exporter($plan, array('template' => $plan->get_template()));
                $record = $exporter->export($output);
                $data->plans[] = $record;
            }
        }

        $data->navigation = array();
        foreach ($this->navigation as $button) {
            $data->navigation[] = $output->render($button);
        }

        return $data;
    }
}
