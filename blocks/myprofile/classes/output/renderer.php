<?php
//

/**
 * myprofile block rendrer
 *
 * @package    block_myprofile
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_myprofile\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * myprofile block renderer
 *
 * @package    block_myprofile
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Return the main content for the block myprofile.
     *
     * @param myprofile $myprofile The myprofile renderable
     * @return string HTML string
     */
    public function render_myprofile(myprofile $myprofile) {
        return $this->render_from_template('block_myprofile/myprofile', $myprofile->export_for_template($this));
    }
}
