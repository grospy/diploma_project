<?php
//

/**
 * Privacy renderer.
 *
 * @package    core_privacy
 * @copyright  2018 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_privacy\output;
defined('MOODLE_INTERNAL') || die;
/**
 * Privacy renderer's for privacy stuff.
 *
 * @since      Moodle 3.6
 * @package    core_privacy
 * @copyright  2018 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {

    /**
     * Render the whole tree.
     *
     * @param navigation_page $page
     * @return string
     */
    public function render_navigation(exported_navigation_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('core_privacy/navigation', $data);
    }

    /**
     * Render the html page.
     *
     * @param html_page $page
     * @return string
     */
    public function render_html_page(exported_html_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('core_privacy/htmlpage', $data);
    }
}