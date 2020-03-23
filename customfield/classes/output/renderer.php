<?php
//

/**
 * Renderer.
 *
 * @package   core_customfield
 * @copyright 2018 David Matamoros <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;

/**
 * Renderer class.
 *
 * @package   core_customfield
 * @copyright 2018 David Matamoros <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Render custom field management interface.
     *
     * @param \core_customfield\output\management $list
     * @return string HTML
     */
    protected function render_management(\core_customfield\output\management $list) {
        $context = $list->export_for_template($this);

        return $this->render_from_template('core_customfield/list', $context);
    }

    /**
     * Render single custom field value
     *
     * @param \core_customfield\output\field_data $field
     * @return string HTML
     */
    protected function render_field_data(\core_customfield\output\field_data $field) {
        $context = $field->export_for_template($this);
        return $this->render_from_template('core_customfield/field_data', $context);
    }
}