<?php
//

/**
 * Provides rendering functionality for the forum summary report subplugin.
 *
 * @package   forumreport_summary
 * @copyright 2019 Michael Hawkins <michaelh@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use forumreport_summary\summary_table;

/**
 * Renderer for the forum summary report.
 *
 * @copyright  2019 Michael Hawkins <michaelh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class forumreport_summary_renderer extends plugin_renderer_base {

    /**
     * Render the filters available for the forum summary report.
     *
     * @param stdClass $cm The course module object.
     * @param moodle_url $actionurl The form action URL.
     * @param array $filters Optional array of currently applied filter values.
     * @return string The filter form HTML.
     */
    public function render_filters_form(stdClass $cm, moodle_url $actionurl, array $filters = []): string {
        $renderable = new \forumreport_summary\output\filters($cm, $actionurl, $filters);
        $templatecontext = $renderable->export_for_template($this);

        return $this->render_from_template('forumreport_summary/filters', $templatecontext);
    }

    /**
     * Render the summary report table.
     *
     * @param summary_table $table The summary table to be rendered.
     * @return string The report table HTML.
     */
    public function render_summary_table(summary_table $table): string {
        // Buffer so calling script can output the report as required.
        ob_start();

        // Render table.
        $table->out($table->get_perpage(), false);

        $tablehtml = ob_get_contents();

        ob_end_clean();

        return $this->render_from_template('forumreport_summary/report', ['tablehtml' => $tablehtml]);
    }
}
