<?php
//

/**
 * Tests for \tool_langimport\locale class.
 *
 * @package    tool_langimport
 * @copyright  2018 Université Rennes 2 {@link https://www.univ-rennes2.fr}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Tests for \tool_langimport\locale class.
 *
 * @copyright  2018 Université Rennes 2 {@link https://www.univ-rennes2.fr}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class locale_testcase extends \advanced_testcase {
    /**
     * Test that \tool_langimport\locale::check_locale_availability() works as expected.
     *
     * @return void
     */
    public function test_check_locale_availability() {
        // Create a mock of set_locale() method to simulate :
        // - first setlocale() call which backup current locale
        // - second setlocale() call which try to set new 'es' locale
        // - third setlocale() call which restore locale.
        $mock = $this->getMockBuilder(\tool_langimport\locale::class)
            ->setMethods(['set_locale'])
            ->getMock();
        $mock->method('set_locale')->will($this->onConsecutiveCalls('en', 'es', 'en'));

        // Test what happen when locale is available on system.
        $result = $mock->check_locale_availability('en');
        $this->assertTrue($result);

        // Create a mock of set_locale() method to simulate :
        // - first setlocale() call which backup current locale
        // - second setlocale() call which fail to set new locale
        // - third setlocale() call which restore locale.
        $mock = $this->getMockBuilder(\tool_langimport\locale::class)
            ->setMethods(['set_locale'])
            ->getMock();
        $mock->method('set_locale')->will($this->onConsecutiveCalls('en', false, 'en'));

        // Test what happen when locale is not available on system.
        $result = $mock->check_locale_availability('en');
        $this->assertFalse($result);

        // Test an invalid parameter.
        $locale = new \tool_langimport\locale();
        $this->expectException(coding_exception::class);
        $locale->check_locale_availability('');
    }
}
