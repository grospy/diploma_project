<?php
//

/**
 * Renderer class for tool customlang
 *
 * @package     tool_customlang
 * @category    output
 * @copyright   2019 Bas Brands <bas@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_customlang\output;

defined('MOODLE_INTERNAL') || die();


/**
 * Renderer for the customlang tool.
 *
 * @copyright 2019 Bas Brands <bas@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param tool_customlang_translator $translator
     * @return string Html for the translator
     */
    protected function render_tool_customlang_translator(\tool_customlang_translator $translator) {
        $renderabletranslator = new translator($translator);
        $templatevars = $renderabletranslator->export_for_template($this);
        return $this->render_from_template('tool_customlang/translator', $templatevars);
    }

    /**
     * Defer to template.
     *
     * @param tool_customlang_menu $menu
     * @return string html the customlang menu buttons
     */
    protected function render_tool_customlang_menu(\tool_customlang_menu $menu) {
        $output = '';
        foreach ($menu->get_items() as $item) {
            $output .= $this->single_button($item->url, $item->title, $item->method);
        }
        return $this->box($output, 'menu');
    }
}
