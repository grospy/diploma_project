<?php
//

/**
 * Class containing data for managecompetencyframeworks page
 *
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use single_button;
use stdClass;
use moodle_url;
use context;
use context_system;
use core_competency\api;
use core_competency\competency_framework;
use core_competency\external\competency_framework_exporter;

/**
 * Class containing data for managecompetencyframeworks page
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manage_competency_frameworks_page implements renderable, templatable {

    /** @var context The context in which everything is happening. */
    protected $pagecontext;

    /** @var array $navigation List of links to display on the page. Each link contains a url and a title. */
    protected $navigation = array();

    /** @var array $competencyframeworks List of competency frameworks. */
    protected $competencyframeworks = array();

    /** @var bool $canmanage Result of permissions checks. */
    protected $canmanage = false;

    /** @var moodle_url $pluginurlbase Base url to use constructing links. */
    protected $pluginbaseurl = null;

    /**
     * Construct this renderable.
     *
     * @param context $pagecontext The page context
     */
    public function __construct(context $pagecontext) {
        $this->pagecontext = $pagecontext;

        if (competency_framework::can_manage_context($this->pagecontext)) {
            $addpage = new single_button(
                new moodle_url('/admin/tool/lp/editcompetencyframework.php', array('pagecontextid' => $this->pagecontext->id)),
                get_string('addnewcompetencyframework', 'tool_lp'),
                'get'
            );
            $this->navigation[] = $addpage;
            $competenciesrepository = new single_button(
                new moodle_url('https://archive.moodle.net/competencies'),
                get_string('competencyframeworksrepository', 'tool_lp'),
                'get'
            );
            $this->navigation[] = $competenciesrepository;
        }

        $this->competencyframeworks = api::list_frameworks('shortname', 'ASC', 0, 0, $this->pagecontext);
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output Renderer base.
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->competencyframeworks = array();
        $data->pagecontextid = $this->pagecontext->id;
        foreach ($this->competencyframeworks as $framework) {
            $exporter = new competency_framework_exporter($framework);
            $data->competencyframeworks[] = $exporter->export($output);
        }
        $data->pluginbaseurl = (new moodle_url('/admin/tool/lp'))->out(true);
        $data->navigation = array();
        foreach ($this->navigation as $button) {
            $data->navigation[] = $output->render($button);
        }

        return $data;
    }
}
