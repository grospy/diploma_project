<?php
//

/**
 * Course competency statistics class
 *
 * @package    tool_lp
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp;
defined('MOODLE_INTERNAL') || die();

use core_competency\api;

/**
 * Course competency statistics class.
 *
 * @package    tool_lp
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_competency_statistics {

    /** @var $competencycount The number of competencies in the course */
    public $competencycount = 0;

    /** @var $proficientcompetencycount The number of proficient competencies for the current user */
    public $proficientcompetencycount = 0;

    /** @var $leastproficientcompetencies The competencies in this course that were proficient the least times */
    public $leastproficientcompetencies = array();

    /**
     * Return the custom definition of the properties of this model.
     *
     * @param int $courseid The course we want to generate statistics for.
     */
    public function __construct($courseid) {
        global $USER;

        $this->competencycount = api::count_competencies_in_course($courseid);
        $this->proficientcompetencycount = api::count_proficient_competencies_in_course_for_user($courseid, $USER->id);
        $this->leastproficientcompetencies = api::get_least_proficient_competencies_for_course($courseid, 0, 3);
    }
}
