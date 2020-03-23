<?php
//

/**
 * The chooser_section renderable.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;
defined('MOODLE_INTERNAL') || die();

use lang_string;
use renderer_base;
use renderable;
use stdClass;
use templatable;

/**
 * The chooser_section renderable class.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class chooser_section implements renderable, templatable {

    /** @var string $id An identifier for the section. */
    public $id;
    /** @var lang_string $label The label of the section. */
    public $label;
    /** @var chooser_item[] $items The items in this section. */
    public $items;

    /**
     * Constructor.
     *
     * @param string $id An identifier for the section.
     * @param lang_string $label The label of the section.
     * @param chooser_item[] $items The items in this section.
     */
    public function __construct($id, lang_string $label, array $items) {
        $this->id = $id;
        $this->label = $label;
        $this->items = $items;
    }

    /**
     * Export for template.
     *
     * @param renderer_base The renderer.
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->id = $this->id;
        $data->label = (string) $this->label;
        $data->items = array_map(function($item) use ($output) {
            return $item->export_for_template($output);
        }, array_values($this->items));
        return $data;
    }

}
