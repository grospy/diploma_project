<?php
//

/**
 * Starred courses block renderer.
 *
 * @package    block_starredcourses
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_starredcourses\output;
defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * Starred courses block renderer.
 *
 * @package    block_starredcourses
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Return the main content for the block.
     *
     * @param main $main The main renderable
     * @return string HTML string
     */
    public function render_main(main $main) {
        return $this->render_from_template('block_starredcourses/main',
            $main->export_for_template($this));
    }
}
