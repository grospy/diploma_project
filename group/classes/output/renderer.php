<?php
//

/**
 * Renderers.
 *
 * @package    core_group
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_group\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;

/**
 * Renderer class.
 *
 * @package    core_group
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param index_page $page
     * @return string
     */
    public function render_index_page(index_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('core_group/index', $data);
    }

    /**
     * Defer to template.
     *
     * @param group_details $page Group details page object.
     * @return string HTML to render the group details.
     */
    public function group_details(group_details $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('core_group/group_details', $data);
    }
}
