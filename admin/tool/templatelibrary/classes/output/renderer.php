<?php
//

/**
 * Renderer class for template library.
 *
 * @package    tool_templatelibrary
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_templatelibrary\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * Renderer class for template library.
 *
 * @package    tool_templatelibrary
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param list_templates_page $page
     *
     * @return string html for the page
     */
    public function render_list_templates_page($page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('tool_templatelibrary/list_templates_page', $data);
    }

}
