<?php
//

/**
 * Categories renderable.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_dataprivacy\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use stdClass;
use templatable;
use tool_dataprivacy\external\category_exporter;

/**
 * Class containing the categories page renderable.
 *
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class categories extends crud_element implements renderable, templatable {

    /** @var array $categories All system categories. */
    protected $categories = [];

    /**
     * Construct this renderable.
     *
     * @param \tool_dataprivacy\category[] $categories
     */
    public function __construct($categories) {
        $this->categories = $categories;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $PAGE;

        $context = \context_system::instance();

        $PAGE->requires->js_call_amd('tool_dataprivacy/categoriesactions', 'init');
        $PAGE->requires->js_call_amd('tool_dataprivacy/add_category', 'getInstance', [$context->id]);

        $data = new stdClass();

        // Navigation links.
        $data->navigation = [];
        $navigationlinks = $this->get_navigation();
        foreach ($navigationlinks as $navlink) {
            $data->navigation[] = $navlink->export_for_template($output);
        }

        $data->categories = [];
        foreach ($this->categories as $category) {
            $exporter = new category_exporter($category, ['context' => \context_system::instance()]);
            $exportedcategory = $exporter->export($output);

            $actionmenu = $this->action_menu('category', $exportedcategory, $category);
            $exportedcategory->actions = $actionmenu->export_for_template($output);
            $data->categories[] = $exportedcategory;
        }

        return $data;
    }
}
