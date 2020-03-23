<?php
//

/**
 * lock unit tests
 *
 * @package    core
 * @category   lock
 * @copyright  2013 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Unit tests for our locking configuration.
 *
 * @package    core
 * @category   lock
 * @copyright  2013 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class lock_config_testcase extends advanced_testcase {

    /**
     * Tests the static parse charset method
     * @return void
     */
    public function test_lock_config() {
        global $CFG;
        $original = null;
        if (isset($CFG->lock_factory)) {
            $original = $CFG->lock_factory;
        }
        $originalfilelocking = null;
        if (isset($CFG->preventfilelocking)) {
            $originalfilelocking = $CFG->preventfilelocking;
        }

        // Test no configuration.
        unset($CFG->lock_factory);
        $CFG->preventfilelocking = 0;
        $factory = \core\lock\lock_config::get_lock_factory('cache');
        $this->assertNotEmpty($factory, 'Get a default factory with no configuration');

        // Test explicit broken lock.
        $CFG->lock_factory = '\core\lock\not_a_lock_factory';
        try {
            $factory = \core\lock\lock_config::get_lock_factory('cache');
            $this->fail('Exception expected');
        } catch (moodle_exception $ex) {
            $this->assertInstanceOf('coding_exception', $ex);
        }

        // Test explicit file locks.
        $CFG->lock_factory = '\core\lock\file_lock_factory';
        $factory = \core\lock\lock_config::get_lock_factory('cache');
        $this->assertTrue($factory instanceof \core\lock\file_lock_factory,
                'Get an explicit file lock factory');

        // Test explicit file locks but with file locks prevented.
        $CFG->preventfilelocking = 1;
        try {
            $factory = \core\lock\lock_config::get_lock_factory('cache');
            $this->fail('Exception expected');
        } catch (moodle_exception $ex) {
            $this->assertInstanceOf('coding_exception', $ex);
        }

        // Test explicit db locks.
        $CFG->lock_factory = '\core\lock\db_record_lock_factory';
        $factory = \core\lock\lock_config::get_lock_factory('cache');
        $this->assertTrue($factory instanceof \core\lock\db_record_lock_factory,
                'Get an explicit db record lock factory');

        if ($original) {
            $CFG->lock_factory = $original;
        } else {
            unset($CFG->lock_factory);
        }
        if ($originalfilelocking) {
            $CFG->preventfilelocking = $originalfilelocking;
        } else {
            unset($CFG->preventfilelocking);
        }
    }
}

