<?php
//
defined('MOODLE_INTERNAL') || exit();

/**
 * Unit tests for the subscription class.
 * @since 3.2.0
 *
 * @package    tool_monitor
 * @category   test
 * @copyright  2016 Jake Dallimore <jrhdallimore@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_monitor_subscription_testcase extends advanced_testcase {

    /**
     * @var \tool_monitor\subscription $subscription object.
     */
    private $subscription;

    /**
     * Test set up.
     */
    public function setUp() {
        $this->resetAfterTest(true);

        // Create the mock subscription.
        $sub = new stdClass();
        $sub->id = 100;
        $sub->name = 'My test rule';
        $sub->courseid = 20;
        $mockbuilder = $this->getMockBuilder('\tool_monitor\subscription');
        $mockbuilder->setMethods(null);
        $mockbuilder->setConstructorArgs(array($sub));
        $this->subscription = $mockbuilder->getMock();
    }

    /**
     * Test for the magic __isset method.
     */
    public function test_magic_isset() {
        $this->assertEquals(true, isset($this->subscription->name));
        $this->assertEquals(true, isset($this->subscription->courseid));
        $this->assertEquals(false, isset($this->subscription->ruleid));
    }

    /**
     * Test for the magic __get method.
     *
     * @expectedException coding_exception
     */
    public function test_magic_get() {
        $this->assertEquals(20, $this->subscription->courseid);
        $this->subscription->ruleid;
    }
}
