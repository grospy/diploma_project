<?php
//

/**
 * User evidence page output.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\output;

use moodle_url;
use renderable;
use templatable;
use stdClass;
use core_competency\api;
use tool_lp\external\user_evidence_summary_exporter;

/**
 * User evidence page class.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_evidence_page implements renderable, templatable {

    /** @var context The context. */
    protected $context;

    /** @var userevidence The user evidence. */
    protected $userevidence;

    /**
     * Construct.
     *
     * @param user_evidence $userevidence
     */
    public function __construct($userevidence) {
        $this->userevidence = $userevidence;
        $this->context = $this->userevidence->get_context();
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(\renderer_base $output) {
        $data = new stdClass();

        $userevidencesummaryexporter = new user_evidence_summary_exporter($this->userevidence, array(
            'context' => $this->context));
        $data->userevidence = $userevidencesummaryexporter->export($output);
        $data->pluginbaseurl = (new moodle_url('/admin/tool/lp'))->out(true);

        return $data;
    }
}
