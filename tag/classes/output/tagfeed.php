<?php
//

/**
 * Contains class core_tag\output\tagfeed
 *
 * @package   core_tag
 * @copyright 2015 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_tag\output;

use templatable;
use renderer_base;
use stdClass;

/**
 * Class to display feed of tagged items
 *
 * @package   core_tag
 * @copyright 2015 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tagfeed implements templatable {

    /** @var array */
    protected $items;

    /**
     * Constructor
     *
     * Usually the most convenient way is to call constructor without arguments and
     * add items later using add() method.
     *
     * @param array $items
     */
    public function __construct($items = array()) {
        $this->items = array();
        if ($items) {
            foreach ($items as $item) {
                $item = (array)$item + array('img' => '', 'heading' => '', 'details' => '');
                $this->add($item['img'], $item['heading'], $item['details']);
            }
        }
    }

    /**
     * Adds one item to the tagfeed
     *
     * @param string $img HTML code representing image (or image wrapped in a link), note that
     *               core_tag/tagfeed template expects image to be 35x35 px
     * @param string $heading HTML for item heading
     * @param string $details HTML for item details (keep short)
     */
    public function add($img, $heading, $details = '') {
        $this->items[] = array('img' => $img, 'heading' => $heading, 'details' => $details);
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        return array('items' => $this->items);
    }
}
