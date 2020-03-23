<?php
//

/**
 * User competency summary.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\output;
defined('MOODLE_INTERNAL') || die();

use core_user;
use renderer_base;
use renderable;
use templatable;
use core_competency\api;
use core_competency\user_competency;
use tool_lp\external\user_competency_summary_exporter;

/**
 * User competency summary class.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_competency_summary implements renderable, templatable {

    /** @var usercompetency */
    protected $usercompetency;
    /** @var array */
    protected $related;

    /**
     * Constructor.
     *
     * @param user_competency $usercompetency The user competency.
     * @param array $related Related objects.
     */
    public function __construct(user_competency $usercompetency, array $related = array()) {
        $this->usercompetency = $usercompetency;
        $this->related = $related;
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        if (!isset($related['user'])) {
            $related['user'] = core_user::get_user($this->usercompetency->get('userid'));
        }
        if (!isset($related['competency'])) {
            $related['competency'] = $this->usercompetency->get_competency();
        }

        $related += array(
            'usercompetency' => $this->usercompetency,
            'usercompetencyplan' => null,
            'usercompetencycourse' => null,
            'evidence' => api::list_evidence($this->usercompetency->get('userid'), $this->usercompetency->get('competencyid')),
            'relatedcompetencies' => api::list_related_competencies($this->usercompetency->get('competencyid'))
        );
        $exporter = new user_competency_summary_exporter(null, $related);
        $data = $exporter->export($output);

        return $data;
    }
}
