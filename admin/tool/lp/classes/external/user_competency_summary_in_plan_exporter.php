<?php
//

/**
 * Class for exporting user competency data with all the evidence in a plan
 *
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\external;
defined('MOODLE_INTERNAL') || die();

use context_user;
use renderer_base;
use stdClass;
use core_competency\external\plan_exporter;

/**
 * Class for exporting user competency data with additional related data in a plan.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_competency_summary_in_plan_exporter extends \core\external\exporter {

    protected static function define_related() {
        // We cache the context so it does not need to be retrieved from the framework every time.
        return array('competency' => '\\core_competency\\competency',
                     'relatedcompetencies' => '\\core_competency\\competency[]',
                     'user' => '\\stdClass',
                     'plan' => '\\core_competency\\plan',
                     'usercompetency' => '\\core_competency\\user_competency?',
                     'usercompetencyplan' => '\\core_competency\\user_competency_plan?',
                     'evidence' => '\\core_competency\\evidence[]');
    }

    protected static function define_other_properties() {
        return array(
            'usercompetencysummary' => array(
                'type' => user_competency_summary_exporter::read_properties_definition()
            ),
            'plan' => array(
                'type' => plan_exporter::read_properties_definition(),
            )
        );
    }

    protected function get_other_values(renderer_base $output) {
        // Arrays are copy on assign.
        $related = $this->related;
        // Remove plan from related as it is not wanted by the user_competency_summary_exporter.
        unset($related['plan']);
        // We do not need user_competency_course in user_competency_summary_exporter.
        $related['usercompetencycourse'] = null;
        $exporter = new user_competency_summary_exporter(null, $related);
        $result = new stdClass();
        $result->usercompetencysummary = $exporter->export($output);

        $exporter = new plan_exporter($this->related['plan'], array('template' => $this->related['plan']->get_template()));
        $result->plan = $exporter->export($output);

        return (array) $result;
    }
}
