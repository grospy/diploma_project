<?php
//

/**
 * Block Tag Youtube tests
 *
 * @package    block_tag_youtube
 * @category   test
 * @copyright  2015 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Block Tag Youtube test class.
 *
 * @package   block_tag_youtube
 * @category  test
 * @copyright 2015 Jun Pataleta
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_block_tag_youtube_testcase extends advanced_testcase {

    /**
     * Testing the tag youtube block's initial state after a new installation.
     *
     * @return void
     */
    public function test_after_install() {
        global $DB;

        $this->resetAfterTest(true);

        // Assert that tag_youtube entry exists and that its visible attribute is set to 0 (disabled).
        $this->assertTrue($DB->record_exists('block', array('name' => 'tag_youtube', 'visible' => 0)));
    }
}
