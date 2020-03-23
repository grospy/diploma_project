<?php
//

/**
 * Recently accessed courses block renderer
 *
 * @package    block_recentlyaccessedcourses
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_recentlyaccessedcourses\output;
defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * Recently accessed courses block renderer
 *
 * @package    block_recentlyaccessedcourses
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Return the main content for the Recently accessed courses block.
     *
     * @param main $main The main renderable
     * @return string HTML string
     */
    public function render_recentcourses(main $main) {
        return $this->render_from_template('block_recentlyaccessedcourses/main', $main->export_for_template($this));
    }
}
