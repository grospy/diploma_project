<?php
//

/**
 * Class containing the filter options data for rendering the unified filter autocomplete element for the course participants page.
 *
 * @package    core_user
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_user\output;

use moodle_url;
use renderable;
use renderer_base;
use stdClass;
use templatable;

defined('MOODLE_INTERNAL') || die();

/**
 * Class containing the filter options data for rendering the unified filter autocomplete element for the course participants page.
 *
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class unified_filter implements renderable, templatable {

    /** @var array $filteroptions The filter options. */
    protected $filteroptions;

    /** @var array $selectedoptions The list of selected filter option values. */
    protected $selectedoptions;

    /** @var moodle_url|string $baseurl The url with params needed to call up this page. */
    protected $baseurl;

    /**
     * unified_filter constructor.
     *
     * @param array $filteroptions The filter options.
     * @param array $selectedoptions The list of selected filter option values.
     * @param string|moodle_url $baseurl The url with params needed to call up this page.
     */
    public function __construct($filteroptions, $selectedoptions, $baseurl = null) {
        $this->filteroptions = $filteroptions;
        $this->selectedoptions = $selectedoptions;
        if (!empty($baseurl)) {
            $this->baseurl = new moodle_url($baseurl);
        }
    }

    /**
     * Function to export the renderer data in a format that is suitable for a mustache template.
     *
     * @param renderer_base $output Used to do a final render of any components that need to be rendered for export.
     * @return stdClass|array
     */
    public function export_for_template(renderer_base $output) {
        global $PAGE;
        $data = new stdClass();
        if (empty($this->baseurl)) {
            $this->baseurl = $PAGE->url;
        }
        $data->action = $this->baseurl->out(false);

        foreach ($this->selectedoptions as $option) {
            if (!isset($this->filteroptions[$option])) {
                $this->filteroptions[$option] = $option;
            }
        }

        $data->filteroptions = [];
        $originalfilteroptions = [];
        foreach ($this->filteroptions as $value => $label) {
            $selected = in_array($value, $this->selectedoptions);
            $filteroption = (object)[
                'value' => $value,
                'label' => $label
            ];
            $originalfilteroptions[] = $filteroption;
            $filteroption->selected = $selected;
            $data->filteroptions[] = $filteroption;
        }
        $data->originaloptionsjson = json_encode($originalfilteroptions);
        return $data;
    }
}