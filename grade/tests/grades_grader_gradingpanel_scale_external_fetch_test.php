<?php
//

/**
 * Unit tests for core_grades\component_gradeitems;
 *
 * @package   core_grades
 * @category  test
 * @copyright 2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

declare(strict_types = 1);

namespace core_grades\grades\grader\gradingpanel\scale\external;

use advanced_testcase;
use coding_exception;
use core_grades\component_gradeitem;
use external_api;
use mod_forum\local\entities\forum as forum_entity;
use moodle_exception;

/**
 * Unit tests for core_grades\component_gradeitems;
 *
 * @package   core_grades
 * @category  test
 * @copyright 2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class fetch_test extends advanced_testcase {

    public static function setupBeforeClass(): void {
        global $CFG;
        require_once("{$CFG->libdir}/externallib.php");
    }

    /**
     * Ensure that an execute with an invalid component is rejected.
     */
    public function test_execute_invalid_component(): void {
        $this->resetAfterTest();
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);

        $this->expectException(coding_exception::class);
        $this->expectExceptionMessage("The 'foo' item is not valid for the 'mod_invalid' component");
        fetch::execute('mod_invalid', 1, 'foo', 2);
    }

    /**
     * Ensure that an execute with an invalid itemname on a valid component is rejected.
     */
    public function test_execute_invalid_itemname(): void {
        $this->resetAfterTest();
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);

        $this->expectException(coding_exception::class);
        $this->expectExceptionMessage("The 'foo' item is not valid for the 'mod_forum' component");
        fetch::execute('mod_forum', 1, 'foo', 2);
    }

    /**
     * Ensure that an execute against a different grading method is rejected.
     */
    public function test_execute_incorrect_type(): void {
        $this->resetAfterTest();

        $forum = $this->get_forum_instance([
            // Negative numbers mean a scale.
            'grade_forum' => 5,
        ]);
        $course = $forum->get_course_record();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'teacher');
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $this->setUser($teacher);

        $gradeitem = component_gradeitem::instance('mod_forum', $forum->get_context(), 'forum');

        $this->expectException(moodle_exception::class);
        $this->expectExceptionMessage("not configured for grading with scales");
        fetch::execute('mod_forum', (int) $forum->get_context()->id, 'forum', (int) $student->id);
    }

    /**
     * Ensure that an execute against the correct grading method returns the current state of the user.
     */
    public function test_execute_fetch_empty(): void {
        $this->resetAfterTest();

        $options = [
            'A',
            'B',
            'C'
        ];
        $scale = $this->getDataGenerator()->create_scale(['scale' => implode(',', $options)]);

        $forum = $this->get_forum_instance([
            // Negative numbers mean a scale.
            'grade_forum' => -1 * $scale->id
        ]);
        $course = $forum->get_course_record();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'teacher');
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $this->setUser($teacher);

        $gradeitem = component_gradeitem::instance('mod_forum', $forum->get_context(), 'forum');

        $result = fetch::execute('mod_forum', (int) $forum->get_context()->id, 'forum', (int) $student->id);
        $result = external_api::clean_returnvalue(fetch::execute_returns(), $result);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('templatename', $result);

        $this->assertEquals('core_grades/grades/grader/gradingpanel/scale', $result['templatename']);

        $this->assertArrayHasKey('grade', $result);
        $this->assertIsArray($result['grade']);

        $this->assertArrayHasKey('options', $result['grade']);
        $this->assertCount(count($options), $result['grade']['options']);
        rsort($options);
        foreach ($options as $index => $option) {
            $this->assertArrayHasKey($index, $result['grade']['options']);

            $returnedoption = $result['grade']['options'][$index];
            $this->assertArrayHasKey('value', $returnedoption);
            $this->assertEquals(3 - $index, $returnedoption['value']);

            $this->assertArrayHasKey('title', $returnedoption);
            $this->assertEquals($option, $returnedoption['title']);

            $this->assertArrayHasKey('selected', $returnedoption);
            $this->assertFalse($returnedoption['selected']);
        }

        $this->assertIsInt($result['grade']['timecreated']);
        $this->assertArrayHasKey('timemodified', $result['grade']);
        $this->assertIsInt($result['grade']['timemodified']);

        $this->assertArrayHasKey('warnings', $result);
        $this->assertIsArray($result['warnings']);
        $this->assertEmpty($result['warnings']);
    }

    /**
     * Ensure that an execute against the correct grading method returns the current state of the user.
     */
    public function test_execute_fetch_graded(): void {
        $this->resetAfterTest();

        $options = [
            'A',
            'B',
            'C'
        ];
        $scale = $this->getDataGenerator()->create_scale(['scale' => implode(',', $options)]);

        $forum = $this->get_forum_instance([
            // Negative numbers mean a scale.
            'grade_forum' => -1 * $scale->id
        ]);
        $course = $forum->get_course_record();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'teacher');
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $this->setUser($teacher);

        $gradeitem = component_gradeitem::instance('mod_forum', $forum->get_context(), 'forum');
        $gradeitem->store_grade_from_formdata($student, $teacher, (object) [
            'grade' => 2,
        ]);

        $result = fetch::execute('mod_forum', (int) $forum->get_context()->id, 'forum', (int) $student->id);
        $result = external_api::clean_returnvalue(fetch::execute_returns(), $result);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('templatename', $result);

        $this->assertEquals('core_grades/grades/grader/gradingpanel/scale', $result['templatename']);

        $result = fetch::execute('mod_forum', (int) $forum->get_context()->id, 'forum', (int) $student->id);
        $result = external_api::clean_returnvalue(fetch::execute_returns(), $result);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('templatename', $result);

        $this->assertEquals('core_grades/grades/grader/gradingpanel/scale', $result['templatename']);

        $this->assertArrayHasKey('grade', $result);
        $this->assertIsArray($result['grade']);

        $this->assertArrayHasKey('options', $result['grade']);
        $this->assertCount(count($options), $result['grade']['options']);
        rsort($options);
        foreach ($options as $index => $option) {
            $this->assertArrayHasKey($index, $result['grade']['options']);

            $returnedoption = $result['grade']['options'][$index];
            $this->assertArrayHasKey('value', $returnedoption);
            $this->assertEquals(3 - $index, $returnedoption['value']);

            $this->assertArrayHasKey('title', $returnedoption);
            $this->assertEquals($option, $returnedoption['title']);

            $this->assertArrayHasKey('selected', $returnedoption);
        }

        // The grade was 2, which relates to the middle option.
        $this->assertFalse($result['grade']['options'][0]['selected']);
        $this->assertTrue($result['grade']['options'][1]['selected']);
        $this->assertFalse($result['grade']['options'][2]['selected']);

        $this->assertIsInt($result['grade']['timecreated']);
        $this->assertArrayHasKey('timemodified', $result['grade']);
        $this->assertIsInt($result['grade']['timemodified']);

        $this->assertArrayHasKey('warnings', $result);
        $this->assertIsArray($result['warnings']);
        $this->assertEmpty($result['warnings']);
    }

    /**
     * Get a forum instance.
     *
     * @param array $config
     * @return forum_entity
     */
    protected function get_forum_instance(array $config = []): forum_entity {
        $this->resetAfterTest();

        $datagenerator = $this->getDataGenerator();
        $course = $datagenerator->create_course();
        $forum = $datagenerator->create_module('forum', array_merge($config, ['course' => $course->id]));

        $vaultfactory = \mod_forum\local\container::get_vault_factory();
        $vault = $vaultfactory->get_forum_vault();

        return $vault->get_from_id((int) $forum->id);
    }
}
