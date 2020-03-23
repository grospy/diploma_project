<?php
//

/**
 * Template persistent class tests.
 *
 * @package    core_competency
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;

use core_competency\template;

/**
 * Template persistent testcase.
 *
 * @package    core_competency
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_competency_template_testcase extends advanced_testcase {

    public function test_validate_duedate() {
        global $DB;

        $this->resetAfterTest();
        $tpl = $this->getDataGenerator()->get_plugin_generator('core_competency')->create_template();

        // No due date -> pass.
        $tpl->set('duedate', 0);
        $this->assertTrue($tpl->is_valid());

        // Setting new due date in the past -> fail.
        $tpl->set('duedate', 1);
        $errors = $tpl->get_errors();
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('duedate', $errors);

        // Setting new due date in very close past -> pass.
        $tpl->set('duedate', time() - 10);
        $this->assertTrue($tpl->is_valid());

        // Setting new due date in future -> pass.
        $tpl->set('duedate', time() + 600);
        $this->assertTrue($tpl->is_valid());

        // Save due date in the future.
        $tpl->update();

        // Going from future date to past -> fail.
        $tpl->set('duedate', 1);
        $errors = $tpl->get_errors();
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('duedate', $errors);

        // Going from future date to none -> pass.
        $tpl->set('duedate', 0);
        $this->assertTrue($tpl->is_valid());

        // Going from future date to other future -> pass.
        $tpl->set('duedate', time() + 6000);
        $this->assertTrue($tpl->is_valid());

        // Going from future date to close past -> pass.
        $tpl->set('duedate', time() - 10);
        $this->assertTrue($tpl->is_valid());

        // Mocking past due date.
        $record = $tpl->to_record();
        $record->duedate = 1;
        $DB->update_record(template::TABLE, $record);
        $tpl->read();
        $this->assertEquals(1, $tpl->get('duedate'));

        // Not changing the past due date -> pass.
        // Note: changing visibility to force validation.
        $tpl->set('visible', 0);
        $tpl->set('visible', 1);
        $this->assertTrue($tpl->is_valid());

        // Changing past due date to other past -> fail.
        $tpl->set('duedate', 10);
        $errors = $tpl->get_errors();
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('duedate', $errors);

        // Changing past due date close past -> pass.
        $tpl->set('duedate', time() + 10);
        $this->assertTrue($tpl->is_valid());

        // Changing past due date to future -> pass.
        $tpl->set('duedate', time() + 1000);
        $this->assertTrue($tpl->is_valid());

        // Changing past due date to none -> pass.
        $tpl->set('duedate', 0);
        $this->assertTrue($tpl->is_valid());
    }
}
