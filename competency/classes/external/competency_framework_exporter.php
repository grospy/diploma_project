<?php
//

/**
 * Class for exporting competency_framework data.
 *
 * @package    core_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_competency\external;
defined('MOODLE_INTERNAL') || die();

use core_competency\api;
use renderer_base;

/**
 * Class for exporting competency_framework data.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_framework_exporter extends \core\external\persistent_exporter {

    /**
     * Define the name of persistent class.
     *
     * @return string
     */
    protected static function define_class() {
        return \core_competency\competency_framework::class;
    }

    /**
     * Get other values that do not belong to the basic persisent.
     *
     * @param renderer_base $output
     * @return Array
     */
    protected function get_other_values(renderer_base $output) {
        $filters = array('competencyframeworkid' => $this->persistent->get('id'));
        $context = $this->persistent->get_context();
        $competenciescount = 0;
        try {
            api::count_competencies($filters);
        } catch (\required_capability_exception $re) {
            $competenciescount = 0;
        }
        return array(
            'canmanage' => has_capability('moodle/competency:competencymanage', $context),
            'competenciescount' => $competenciescount,
            'contextname' => $context->get_context_name(),
            'contextnamenoprefix' => $context->get_context_name(false)
        );
    }

    /**
     * Define other properties that do not belong to the basic persisent.
     *
     * @return Array
     */
    protected static function define_other_properties() {
        return array(
            'canmanage' => array(
                'type' => PARAM_BOOL
            ),
            'competenciescount' => array(
                'type' => PARAM_INT
            ),

            // Both contexts need to be PARAM_RAW because the method context::get_context_name()
            // already applies the formatting and thus could return HTML content.
            'contextname' => array(
                'type' => PARAM_RAW
            ),
            'contextnamenoprefix' => array(
                'type' => PARAM_RAW
            )
        );
    }

}
