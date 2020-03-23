<?php
//

/**
 * Course module competency persistent class tests.
 *
 * @package    core_competency
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;

use core_competency\course_module_competency;

/**
 * Course module competency persistent testcase.
 *
 * @package    core_competency
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_competency_course_module_competency_testcase extends advanced_testcase {

    public function test_count_competencies() {
        global $CFG, $DB;

        $this->resetAfterTest(true);
        $dg = $this->getDataGenerator();
        $lpg = $dg->get_plugin_generator('core_competency');

        $c1 = $dg->create_course();
        $u1 = $dg->create_user();
        $u2 = $dg->create_user();

        $framework = $lpg->create_framework();
        $comp1 = $lpg->create_competency(array('competencyframeworkid' => $framework->get('id')));   // In C1, and C2.
        $comp2 = $lpg->create_competency(array('competencyframeworkid' => $framework->get('id')));   // In C2.
        $lpg->create_course_competency(array('competencyid' => $comp1->get('id'), 'courseid' => $c1->id));
        $lpg->create_course_competency(array('competencyid' => $comp2->get('id'), 'courseid' => $c1->id));

        $assign1a = $dg->create_module('assign', ['course' => $c1]);
        $assign1b = $dg->create_module('assign', ['course' => $c1]);
        $cmc1a = $lpg->create_course_module_competency(['competencyid' => $comp1->get('id'), 'cmid' => $assign1a->cmid]);
        $cmc1b = $lpg->create_course_module_competency(['competencyid' => $comp1->get('id'), 'cmid' => $assign1b->cmid]);
        $cmc2b = $lpg->create_course_module_competency(['competencyid' => $comp2->get('id'), 'cmid' => $assign1b->cmid]);

        // Enrol the user 1 in C1.
        $dg->enrol_user($u1->id, $c1->id);

        $all = course_module_competency::list_course_module_competencies($assign1a->cmid);
        $this->assertEquals(course_module_competency::count_competencies($assign1a->cmid), count($all));

        $all = course_module_competency::list_course_module_competencies($assign1b->cmid);
        $this->assertEquals(course_module_competency::count_competencies($assign1b->cmid), count($all));
    }

}
