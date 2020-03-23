<?php
//

/**
 * Renderers.
 *
 * @package    tool_langimport
 * @copyright  2016 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_langimport\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;

/**
 * Renderer class.
 *
 * @package    tool_langimport
 * @copyright  2016 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param langimport_page $page
     * @return string
     */
    public function render_langimport_page(langimport_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('tool_langimport/langimport', $data);
    }
}
