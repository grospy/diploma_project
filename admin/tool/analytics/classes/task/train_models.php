<?php
//

/**
 * Train system models with new data available.
 *
 * @package    tool_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_analytics\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Train system models with new data available.
 *
 * @package    tool_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class train_models extends \core\task\scheduled_task {

    /**
     * get_name
     *
     * @return string
     */
    public function get_name() {
        return get_string('trainmodels', 'tool_analytics');
    }

    /**
     * Executes the prediction task.
     *
     * @return void
     */
    public function execute() {
        global $OUTPUT, $PAGE;

        if (!\core_analytics\manager::is_analytics_enabled()) {
            mtrace(get_string('analyticsdisabled', 'analytics'));
            return;
        }

        $models = \core_analytics\manager::get_all_models(true);
        if (!$models) {
            mtrace(get_string('errornoenabledmodels', 'tool_analytics'));
            return;
        }

        foreach ($models as $model) {

            if ($model->is_static()) {
                // Skip models based on assumptions.
                continue;
            }

            if (!$model->get_time_splitting()) {
                // Can not train if there is no time splitting method selected.
                continue;
            }

            $renderer = $PAGE->get_renderer('tool_analytics');

            $result = $model->train();

            // Reset the page as some indicators may call external functions that overwrite the page context.
            \tool_analytics\output\helper::reset_page();

            if ($result) {
                echo $OUTPUT->heading(get_string('modelresults', 'tool_analytics', $model->get_name()));
                echo $renderer->render_get_predictions_results($result, $model->get_analyser()->get_logs());
            }
        }
    }
}
