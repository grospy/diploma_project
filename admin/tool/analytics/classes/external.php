<?php
//

/**
 * This is the external API for this component.
 *
 * @package    tool_analytics
 * @copyright  2019 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_analytics;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");

use external_api;
use external_function_parameters;
use external_value;
use external_single_structure;
use external_multiple_structure;

/**
 * This is the external API for this component.
 *
 * @copyright  2019 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external extends external_api {

    const MAX_CONTEXTS_RETURNED = 100;

    /**
     * potential_contexts parameters.
     *
     * @since  Moodle 3.8
     * @return external_function_parameters
     */
    public static function potential_contexts_parameters() {
        return new external_function_parameters(
            array(
                'query' => new external_value(PARAM_NOTAGS, 'The model id', VALUE_DEFAULT),
                'modelid' => new external_value(PARAM_INT, 'The model id', VALUE_DEFAULT)
            )
        );
    }

    /**
     * Return the contexts that match the provided query.
     *
     * @since  Moodle 3.8
     * @param  string|null $query
     * @param  int|null $modelid
     * @return array an array of contexts
     */
    public static function potential_contexts(?string $query = null, ?int $modelid = null) {

        $params = self::validate_parameters(self::potential_contexts_parameters(), ['modelid' => $modelid, 'query' => $query]);

        \core_analytics\manager::check_can_manage_models();

        if ($params['modelid']) {
            $model = new \core_analytics\model($params['modelid']);
            $contexts = ($model->get_analyser(['notimesplitting' => true]))::potential_context_restrictions($params['query']);
        } else {
            $contexts = \core_analytics\manager::get_potential_context_restrictions(null, $params['query']);
        }

        $contextoptions = [];
        $i = 0;
        foreach ($contexts as $contextid => $contextname) {

            if ($i === self::MAX_CONTEXTS_RETURNED) {
                // Limited to MAX_CONTEXTS_RETURNED items.
                break;
            }

            $contextoptions[] = ['id' => $contextid, 'name' => $contextname];
            $i++;
        }

        return $contextoptions;
    }

    /**
     * potential_contexts return
     *
     * @since  Moodle 3.8
     * @return external_description
     */
    public static function potential_contexts_returns() {
        return new external_multiple_structure(
            new external_single_structure([
                'id'    => new external_value(PARAM_INT, 'ID of the context'),
                'name'  => new external_value(PARAM_NOTAGS, 'The context name')
            ])
        );
    }
}
