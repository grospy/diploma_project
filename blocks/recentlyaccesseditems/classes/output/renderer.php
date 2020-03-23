<?php
//
/**
 * Recently accessed items block renderer
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_recentlyaccesseditems\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * Recently accessed items block renderer
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {
    /**
     * Return the main content for the Recently accessed items block.
     *
     * @param \renderer_base $main The main renderable
     * @return string HTML string
     */
    public function render_recentlyaccesseditems(renderer_base $main) {
        return $this->render_from_template('block_recentlyaccesseditems/main', $main->export_for_template($this));
    }
}