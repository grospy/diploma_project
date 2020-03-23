<?php
//

/**
 * Helper class that contains helper functions for cli scripts.
 *
 * @package   tool_analytics
 * @copyright 2017 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_analytics;

defined('MOODLE_INTERNAL') || die();

/**
 * Helper class that contains helper functions for cli scripts.
 *
 * @package   tool_analytics
 * @copyright 2017 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class clihelper {

    /**
     * List all models in the system. To be used from cli scripts.
     *
     * @return void
     */
    public static function list_models() {
        cli_heading("List of models");
        echo str_pad(get_string('modelid', 'tool_analytics'), 15, ' ') . ' ' . str_pad(get_string('name'), 50, ' ') .
            ' ' . str_pad(get_string('status'), 15, ' ') . "\n";
        $models = \core_analytics\manager::get_all_models();
        foreach ($models as $model) {
            $modelid = $model->get_id();
            $isenabled = $model->is_enabled() ? get_string('enabled', 'tool_analytics') : get_string('disabled', 'tool_analytics');
            $name = $model->get_name();
            echo str_pad($modelid, 15, ' ') . ' ' . str_pad($name, 50, ' ') . ' ' . str_pad($isenabled, 15, ' ') . "\n";
        }
    }
}