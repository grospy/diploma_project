<?php
//

/**
 * This file contains the unittests for the css optimiser in csslib.php
 *
 * @package   core_css
 * @category  phpunit
 * @copyright 2012 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/csslib.php');


/**
 * CSS optimiser test class.
 *
 * @package core_css
 * @category phpunit
 * @copyright 2012 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_csslib_testcase extends advanced_testcase {

    /**
     * Test that css_is_colour function throws an exception.
     */
    public function test_css_is_colour() {
        $this->expectException('coding_exception');
        $this->expectExceptionMessage('css_is_colour() can not be used anymore.');
        css_is_colour();
    }

    /**
     * Test that css_is_width function throws an exception.
     */
    public function test_css_is_width() {
        $this->expectException('coding_exception');
        $this->expectExceptionMessage('css_is_width() can not be used anymore.');
        css_is_width();
    }
}
