<?php
//

/**
 * Unit Tests for the approved contextlist Class
 *
 * @package     core_privacy
 * @category    test
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

use \core_privacy\local\request\approved_contextlist;

/**
 * Tests for the \core_privacy API's approved contextlist functionality.
 *
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \core_privacy\local\request\approved_contextlist
 */
class approved_contextlist_test extends advanced_testcase {

    /**
     * The approved contextlist should not be modifiable once set.
     *
     * @covers ::__construct
     * @covers \core_privacy\local\request\approved_contextlist<extended>
     */
    public function test_default_values_set() {
        $testuser = \core_user::get_user_by_username('admin');
        $contextids = [3, 2, 1];
        $component = 'core_privacy';

        $uit = new approved_contextlist($testuser, $component, $contextids);

        $this->assertEquals($testuser, $uit->get_user());
        $this->assertEquals($component, $uit->get_component());
        $result = $uit->get_contextids();

        // Note: Array order is not guaranteed and should not matter.
        foreach ($contextids as $contextid) {
            $this->assertNotFalse(array_search($contextid, $result));
        }
    }
}
