<?php
//

/**
 * Unit Tests for the approved userlist Class
 *
 * @package     core_privacy
 * @category    test
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

use \core_privacy\local\request\approved_userlist;
use \core_privacy\local\request\userlist;

/**
 * Tests for the \core_privacy API's approved userlist functionality.
 *
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \core_privacy\local\request\approved_userlist
 */
class approved_userlist_test extends advanced_testcase {
    /**
     * The approved userlist should not be modifiable once set.
     *
     * @covers ::__construct
     * @covers \core_privacy\local\request\approved_userlist<extended>
     */
    public function test_default_values_set() {
        $this->resetAfterTest();

        $u1 = $this->getDataGenerator()->create_user();
        $u2 = $this->getDataGenerator()->create_user();
        $u3 = $this->getDataGenerator()->create_user();
        $u4 = $this->getDataGenerator()->create_user();

        $context = \context_system::instance();
        $component = 'core_privacy';

        $uut = new approved_userlist($context, $component, [$u1->id, $u2->id]);

        $this->assertEquals($context, $uut->get_context());
        $this->assertEquals($component, $uut->get_component());

        $expected = [
            $u1->id,
            $u2->id,
        ];
        sort($expected);

        $result = $uut->get_userids();
        sort($result);

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers ::create_from_userlist
     * @covers \core_privacy\local\request\approved_userlist<extended>
     */
    public function test_create_from_userlist() {
        $this->resetAfterTest();

        $u1 = $this->getDataGenerator()->create_user();
        $u2 = $this->getDataGenerator()->create_user();
        $u3 = $this->getDataGenerator()->create_user();
        $u4 = $this->getDataGenerator()->create_user();

        $context = \context_system::instance();
        $component = 'core_privacy';

        $sourcelist = new userlist($context, $component);
        $sourcelist->add_users([$u1->id, $u3->id]);

        $expected = [
            $u1->id,
            $u3->id,
        ];
        sort($expected);

        $approvedlist = approved_userlist::create_from_userlist($sourcelist);

        $this->assertEquals($component, $approvedlist->get_component());
        $this->assertEquals($context, $approvedlist->get_context());

        $result = $approvedlist->get_userids();
        sort($result);
        $this->assertEquals($expected, $result);
    }
}
