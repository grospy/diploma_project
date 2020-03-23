<?php
//

/**
 * Search area category.
 *
 * @package     core_search
 * @copyright   Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_search;

defined('MOODLE_INTERNAL') || die();

/**
 * Search area category.
 *
 * @package     core_search
 * @copyright   Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class area_category {

    /**
     * Category name.
     * @var string
     */
    protected $name;

    /**
     * Category visible name.
     * @var string
     */
    protected $visiblename;

    /**
     * Category order.
     * @var int
     */
    protected $order = 0;

    /**
     * Category areas.
     * @var \core_search\base[]
     */
    protected $areas = [];

    /**
     * Constructor.
     *
     * @param string $name Unique name of the category.
     * @param string $visiblename Visible name of the category.
     * @param int $order Category position in the list (smaller numbers will be displayed first).
     * @param \core_search\base[] $areas A list of search areas associated with this category.
     */
    public function __construct(string $name, string $visiblename, int $order = 0, array  $areas = []) {
        $this->name = $name;
        $this->visiblename = $visiblename;
        $this->order = $order;
        $this->set_areas($areas);
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Get visible name.
     *
     * @return string
     */
    public function get_visiblename() {
        return $this->visiblename;
    }

    /**
     * Get order to display.
     *
     * @return int
     */
    public function get_order() {
        return $this->order;
    }

    /**
     * Return a keyed by area id list of areas for this category.
     *
     * @return \core_search\base[]
     */
    public function get_areas() {
        return $this->areas;
    }

    /**
     * Set list of search areas for this category,
     *
     * @param \core_search\base[] $areas
     */
    public function set_areas(array $areas) {
        foreach ($areas as $area) {
            if ($area instanceof base && !key_exists($area->get_area_id(), $this->areas)) {
                $this->areas[$area->get_area_id()] = $area;
            }
        }
    }

}
