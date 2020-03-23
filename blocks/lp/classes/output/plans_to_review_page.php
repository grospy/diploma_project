<?php
//

/**
 * Plans to review renderable.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_lp\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use stdClass;
use moodle_url;
use core_competency\api;
use core_competency\external\plan_exporter;
use core_user\external\user_summary_exporter;

/**
 * Plans to review renderable class.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plans_to_review_page implements renderable, templatable {

    /** @var array Plans to review. */
    protected $planstoreview;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->planstoreview = api::list_plans_to_review(0, 1000);
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();

        $planstoreview = array();
        foreach ($this->planstoreview['plans'] as $plandata) {
            $planexporter = new plan_exporter($plandata->plan, array('template' => $plandata->template));
            $userexporter = new user_summary_exporter($plandata->owner);
            $planstoreview[] = array(
                'plan' => $planexporter->export($output),
                'user' => $userexporter->export($output),
            );
        }

        $data = array(
            'plans' => $planstoreview,
            'pluginbaseurl' => (new moodle_url('/blocks/lp'))->out(false),
        );

        return $data;
    }

}
