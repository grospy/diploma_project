<?php
//

/**
 * This file contains tests for the question_usage_by_activity class.
 *
 * @package   core_question
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once(__DIR__ . '/../lib.php');
require_once(__DIR__ . '/helpers.php');


/**
 * Unit tests for the question_usage_by_activity class.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_usage_by_activity_test extends advanced_testcase {

    public function test_set_get_preferred_model() {
        // Set up
        $quba = question_engine::make_questions_usage_by_activity('unit_test',
                context_system::instance());

        // Exercise SUT and verify.
        $quba->set_preferred_behaviour('deferredfeedback');
        $this->assertEquals('deferredfeedback', $quba->get_preferred_behaviour());
    }

    public function test_set_get_id() {
        // Set up
        $quba = question_engine::make_questions_usage_by_activity('unit_test',
                context_system::instance());

        // Exercise SUT and verify
        $quba->set_id_from_database(123);
        $this->assertEquals(123, $quba->get_id());
    }

    public function test_fake_id() {
        // Set up
        $quba = question_engine::make_questions_usage_by_activity('unit_test',
                context_system::instance());

        // Exercise SUT and verify
        $this->assertNotEmpty($quba->get_id());
    }

    public function test_create_usage_and_add_question() {
        // Exercise SUT
        $context = context_system::instance();
        $quba = question_engine::make_questions_usage_by_activity('unit_test', $context);
        $quba->set_preferred_behaviour('deferredfeedback');
        $tf = test_question_maker::make_question('truefalse', 'true');
        $slot = $quba->add_question($tf);

        // Verify.
        $this->assertEquals($slot, 1);
        $this->assertEquals('unit_test', $quba->get_owning_component());
        $this->assertSame($context, $quba->get_owning_context());
        $this->assertEquals($quba->question_count(), 1);
        $this->assertEquals($quba->get_question_state($slot), question_state::$notstarted);
    }

    public function test_get_question() {
        // Set up.
        $quba = question_engine::make_questions_usage_by_activity('unit_test',
                context_system::instance());
        $quba->set_preferred_behaviour('deferredfeedback');
        $tf = test_question_maker::make_question('truefalse', 'true');
        $slot = $quba->add_question($tf);

        // Exercise SUT and verify.
        $this->assertSame($tf, $quba->get_question($slot));

        $this->expectException('moodle_exception');
        $quba->get_question($slot + 1);
    }

    public function test_extract_responses() {
        // Start a deferred feedback attempt with CBM and add the question to it.
        $tf = test_question_maker::make_question('truefalse', 'true');
        $quba = question_engine::make_questions_usage_by_activity('unit_test',
                context_system::instance());
        $quba->set_preferred_behaviour('deferredcbm');
        $slot = $quba->add_question($tf);
        $quba->start_all_questions();

        // Prepare data to be submitted
        $prefix = $quba->get_field_prefix($slot);
        $answername = $prefix . 'answer';
        $certaintyname = $prefix . '-certainty';
        $getdata = array(
            $answername => 1,
            $certaintyname => 3,
            'irrelevant' => 'should be ignored',
        );

        // Exercise SUT
        $submitteddata = $quba->extract_responses($slot, $getdata);

        // Verify.
        $this->assertEquals(array('answer' => 1, '-certainty' => 3), $submitteddata);
    }

    public function test_access_out_of_sequence_throws_exception() {
        // Start a deferred feedback attempt with CBM and add the question to it.
        $tf = test_question_maker::make_question('truefalse', 'true');
        $quba = question_engine::make_questions_usage_by_activity('unit_test',
                context_system::instance());
        $quba->set_preferred_behaviour('deferredcbm');
        $slot = $quba->add_question($tf);
        $quba->start_all_questions();

        // Prepare data to be submitted
        $prefix = $quba->get_field_prefix($slot);
        $answername = $prefix . 'answer';
        $certaintyname = $prefix . '-certainty';
        $postdata = array(
            $answername => 1,
            $certaintyname => 3,
            $prefix . ':sequencecheck' => 1,
            'irrelevant' => 'should be ignored',
        );

        // Exercise SUT - no exception yet.
        $quba->process_all_actions($slot, $postdata);

        $postdata = array(
            $answername => 1,
            $certaintyname => 3,
            $prefix . ':sequencecheck' => 3,
            'irrelevant' => 'should be ignored',
        );

        // Exercise SUT - now it should fail.
        $this->expectException('question_out_of_sequence_exception');
        $quba->process_all_actions($slot, $postdata);
    }
}
