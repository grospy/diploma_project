<?php
//

/**
 * Generator tests.
 *
 * @package    mod_choice
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Generator tests class.
 *
 * @package    mod_choice
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_choice_generator_testcase extends advanced_testcase {

    public function test_create_instance() {
        global $DB;
        $this->resetAfterTest();
        $this->setAdminUser();

        $course = $this->getDataGenerator()->create_course();

        $this->assertFalse($DB->record_exists('choice', array('course' => $course->id)));
        $choice = $this->getDataGenerator()->create_module('choice', array('course' => $course->id));
        $this->assertEquals(1, $DB->count_records('choice', array('course' => $course->id)));
        $this->assertTrue($DB->record_exists('choice', array('course' => $course->id)));
        $this->assertTrue($DB->record_exists('choice', array('id' => $choice->id)));

        $params = array('course' => $course->id, 'name' => 'One more choice');
        $choice = $this->getDataGenerator()->create_module('choice', $params);
        $this->assertEquals(2, $DB->count_records('choice', array('course' => $course->id)));
        $this->assertEquals('One more choice', $DB->get_field_select('choice', 'name', 'id = :id', array('id' => $choice->id)));

        $params = new stdClass();
        $params->course = $course->id;
        $params->option = array('fried rice', 'spring rolls', 'sweet and sour pork', 'satay beef', 'gyouza');
        $choice = $this->getDataGenerator()->create_module('choice', $params);
        $this->assertEquals(5, $DB->count_records('choice_options', array('choiceid' => $choice->id)));
    }
}
