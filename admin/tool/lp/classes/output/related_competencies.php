<?php
//

/**
 * Class containing data for a competency.
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
use moodle_url;
use core_competency\api;
use core_competency\external\competency_exporter;

/**
 * Class containing data for related competencies.
 *
 * @package    tool_lp
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class related_competencies implements renderable, templatable {

    /** @var array Related competencies. */
    protected $relatedcompetencies = null;

    /**
     * Construct this renderable.
     *
     * @param int $competencyid
     */
    public function __construct($competencyid) {
        $this->competency = api::read_competency($competencyid);
        $this->context = $this->competency->get_context();
        $this->relatedcompetencies = api::list_related_competencies($competencyid);
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->relatedcompetencies = array();
        if ($this->relatedcompetencies) {
            foreach ($this->relatedcompetencies as $competency) {
                $exporter = new competency_exporter($competency, array('context' => $this->context));
                $record = $exporter->export($output);
                $data->relatedcompetencies[] = $record;
            }
        }

        // We checked the user permissions in the constructor.
        $data->showdeleterelatedaction = true;

        return $data;
    }
}
