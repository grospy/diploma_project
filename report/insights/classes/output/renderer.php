<?php
//

/**
 * Renderer.
 *
 * @package    report_insights
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace report_insights\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use templatable;
use renderable;

/**
 * Renderer class.
 *
 * @package    report_insights
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Renders the list of insights
     *
     * @param renderable $renderable
     * @return string HTML
     */
    protected function render_insights_list(renderable $renderable) {
        $data = $renderable->export_for_template($this);
        return parent::render_from_template('report_insights/insights_list', $data);
    }

    /**
     * Renders an insight
     *
     * @param renderable $renderable
     * @return string HTML
     */
    protected function render_insight(renderable $renderable) {
        $data = $renderable->export_for_template($this);
        $renderable->get_model()->get_target()->add_bulk_actions_js();
        return parent::render_from_template('report_insights/insight_details', $data);
    }

    /**
     * Model disabled info.
     *
     * @param \stdClass $insightinfo
     * @return string HTML
     */
    public function render_model_disabled($insightinfo) {
        global $OUTPUT, $PAGE;

        // We don't want to disclose the name of the model if it has not been enabled.
        $PAGE->set_title($insightinfo->contextname);
        $PAGE->set_heading($insightinfo->contextname);

        $output = $OUTPUT->header();
        $output .= $OUTPUT->notification(get_string('disabledmodel', 'report_insights'), \core\output\notification::NOTIFY_INFO);
        $output .= $OUTPUT->footer();

        return $output;
    }

    /**
     * Model without insights info.
     *
     * @param \context $context
     * @return string HTML
     */
    public function render_no_insights(\context $context) {
        global $OUTPUT, $PAGE;

        // We don't want to disclose the name of the model if it has not been enabled.
        $PAGE->set_title($context->get_context_name());
        $PAGE->set_heading($context->get_context_name());

        $output = $OUTPUT->header();
        $output .= $OUTPUT->notification(get_string('noinsights', 'analytics'), \core\output\notification::NOTIFY_INFO);
        $output .= $OUTPUT->footer();

        return $output;
    }

    /**
     * Model which target does not generate insights.
     *
     * @param \context $context
     * @return string HTML
     */
    public function render_no_insights_model(\context $context) {
        global $OUTPUT, $PAGE;

        // We don't want to disclose the name of the model if it has not been enabled.
        $PAGE->set_title($context->get_context_name());
        $PAGE->set_heading($context->get_context_name());

        $output = $OUTPUT->header();
        $output .= $OUTPUT->notification(get_string('noinsightsmodel', 'analytics'), \core\output\notification::NOTIFY_INFO);
        $output .= $OUTPUT->footer();

        return $output;
    }

    /**
     * Renders an analytics disabled notification.
     *
     * @return string HTML
     */
    public function render_analytics_disabled() {
        global $OUTPUT, $PAGE, $FULLME;

        $PAGE->set_url($FULLME);
        $PAGE->set_title(get_string('pluginname', 'report_insights'));
        $PAGE->set_heading(get_string('pluginname', 'report_insights'));

        $output = $OUTPUT->header();
        $output .= $OUTPUT->notification(get_string('analyticsdisabled', 'analytics'), \core\output\notification::NOTIFY_INFO);
        $output .= \html_writer::tag('a', get_string('continue'), ['class' => 'btn btn-primary',
            'href' => (new \moodle_url('/'))->out()]);
        $output .= $OUTPUT->footer();

        return $output;
    }
}
