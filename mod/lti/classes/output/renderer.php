<?php
//

/**
 * Renderer class for template library.
 *
 * @package    mod_lti
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_lti\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * Renderer class for template library.
 *
 * @package    mod_lti
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param tool_configure_page $page
     *
     * @return string html for the page
     */
    public function render_tool_configure_page($page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('mod_lti/tool_configure', $data);
    }

    /**
     * Render the external registration return page
     *
     * @param tool_configure_page $page
     *
     * @return string html for the page
     */
    public function render_external_registration_return_page($page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('mod_lti/external_registration_return', $data);
    }
}
