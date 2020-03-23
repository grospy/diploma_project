<?php
//

/**
 * Block LP renderer.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_lp\output;
defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use renderable;

/**
 * Block LP renderer class.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     * @param renderable $page
     * @return string
     */
    public function render_competencies_to_review_page(renderable $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('block_lp/competencies_to_review_page', $data);
    }

    /**
     * Defer to template.
     * @param renderable $page
     * @return string
     */
    public function render_plans_to_review_page(renderable $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('block_lp/plans_to_review_page', $data);
    }

    /**
     * Defer to template.
     * @param renderable $summary
     * @return string
     */
    public function render_summary(renderable $summary) {
        $data = $summary->export_for_template($this);
        return parent::render_from_template('block_lp/summary', $data);
    }

}
