<?php
//

/**
 * Renderers.
 *
 * @package    tool_lpmigrate
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lpmigrate\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use renderable;

/**
 * Renderer class.
 *
 * @package    tool_lpmigrate
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param migrate_framework_results $page
     * @return string
     */
    public function render_migrate_framework_results(migrate_framework_results $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('tool_lpmigrate/migrate_frameworks_results', $data);
    }
}
