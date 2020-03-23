<?php
//

/**
 * Class for exporting plan competency data.
 *
 * @package    core_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_competency\external;
defined('MOODLE_INTERNAL') || die();

use context_system;
use renderer_base;
use stdClass;

/**
 * Class for exporting plan competency data.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_competency_plan_exporter extends \core\external\persistent_exporter {

    protected static function define_class() {
        return \core_competency\user_competency_plan::class;
    }

    protected static function define_related() {
        // We cache the scale so it does not need to be retrieved from the framework every time.
        return array('scale' => 'grade_scale');
    }

    protected function get_other_values(renderer_base $output) {
        $result = new stdClass();

        if ($this->persistent->get('grade') === null) {
            $gradename = '-';
        } else {
            $gradename = $this->related['scale']->scale_items[$this->persistent->get('grade') - 1];
        }
        $result->gradename = $gradename;

        if ($this->persistent->get('proficiency') === null) {
            $proficiencyname = get_string('no');
        } else {
            $proficiencyname = get_string($this->persistent->get('proficiency') ? 'yes' : 'no');
        }
        $result->proficiencyname = $proficiencyname;

        return (array) $result;
    }

    /**
     * Get the format parameters for gradename.
     *
     * @return array
     */
    protected function get_format_parameters_for_gradename() {
        return [
            'context' => context_system::instance(), // The system context is cached, so we can get it right away.
        ];
    }

    protected static function define_other_properties() {
        return array(
            'gradename' => array(
                'type' => PARAM_TEXT
            ),
            'proficiencyname' => array(
                'type' => PARAM_RAW
            ),
        );
    }
}
