<?php
//

/**
 * Block search forums renderer.
 *
 * @package    block_search_forums
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_search_forums\output;
defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use renderable;

/**
 * Block search forums renderer.
 *
 * @package    block_search_forums
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Render search form.
     *
     * @param renderable $searchform The search form.
     * @return string
     */
    public function render_search_form(renderable $searchform) {
        return $this->render_from_template('block_search_forums/search_form', $searchform->export_for_template($this));
    }

}
