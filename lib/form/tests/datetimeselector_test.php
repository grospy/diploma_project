<?php
//

/**
 * Unit tests for datetimeselector form element
 *
 * This file contains unit test related to datetimeselector form element
 *
 * @package    core_form
 * @category   phpunit
 * @copyright  2012 Rajesh Taneja
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/form/datetimeselector.php');
require_once($CFG->libdir.'/formslib.php');

/**
 * Unit tests for MoodleQuickForm_date_time_selector
 *
 * Contains test cases for testing MoodleQuickForm_date_time_selector
 *
 * @package    core_form
 * @category   phpunit
 * @copyright  2012 Rajesh Taneja
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_form_datetimeselector_testcase extends advanced_testcase {
    /** @var MoodleQuickForm Keeps reference of dummy form object */
    private $mform;
    /** @var array test fixtures */
    private $testvals;

    /**
     * Initalize test wide variable, it is called in start of the testcase
     */
    protected function setUp() {
        global $CFG;
        parent::setUp();

        $this->resetAfterTest();
        $this->setAdminUser();

        $this->setTimezone('Australia/Perth');

        // Get form data.
        $form = new temp_form_datetime();
        $this->mform = $form->getform();

        // Set test values.
        $this->testvals = array(
            array (
                'minute' => 0,
                'hour' => 0,
                'day' => 1,
                'month' => 7,
                'year' => 2011,
                'usertimezone' => 'America/Moncton',
                'timezone' => 'America/Moncton',
                'timestamp' => 1309489200
            ),
            array (
                'minute' => 0,
                'hour' => 0,
                'day' => 1,
                'month' => 7,
                'year' => 2011,
                'usertimezone' => 'America/Moncton',
                'timezone' => 99,
                'timestamp' => 1309489200
            ),
            array (
                'minute' => 0,
                'hour' => 23,
                'day' => 30,
                'month' => 6,
                'year' => 2011,
                'usertimezone' => 'America/Moncton',
                'timezone' => -4,
                'timestamp' => 1309489200
            ),
            array (
                'minute' => 0,
                'hour' => 23,
                'day' => 30,
                'month' => 6,
                'year' => 2011,
                'usertimezone' => -4,
                'timezone' => 99,
                'timestamp' => 1309489200
            ),
            array (
                'minute' => 0,
                'hour' => 0,
                'day' => 1,
                'month' => 7,
                'year' => 2011,
                'usertimezone' => 0.0,
                'timezone' => 0.0,
                'timestamp' => 1309478400 // 6am at UTC+0
            ),
            array (
                'minute' => 0,
                'hour' => 0,
                'day' => 1,
                'month' => 7,
                'year' => 2011,
                'usertimezone' => 0.0,
                'timezone' => 99,
                'timestamp' => 1309478400 // 6am at UTC+0
            )
        );
    }

    /**
     * Testcase to check exportvalue
     */
    public function test_exportvalue() {
        global $USER;
        $testvals = $this->testvals;

        foreach ($testvals as $vals) {
            // Set user timezone to test value.
            $USER->timezone = $vals['usertimezone'];

            // Create dateselector element with different timezones.
            $elparams = array('optional'=>false, 'timezone' => $vals['timezone']);
            $el = $this->mform->addElement('date_time_selector', 'dateselector', null, $elparams);
            $this->assertTrue($el instanceof MoodleQuickForm_date_time_selector);
            $submitvalues = array('dateselector' => $vals);

            $this->assertSame(array('dateselector' => $vals['timestamp']), $el->exportValue($submitvalues, true),
                    "Please check if timezones are updated (Site adminstration -> location -> update timezone)");
        }
    }

    /**
     * Testcase to check onQuickformEvent
     */
    public function test_onquickformevent() {
        global $USER;
        $testvals = $this->testvals;
        // Get dummy form for data.
        $mform = $this->mform;

        foreach ($testvals as $vals) {
            // Set user timezone to test value.
            $USER->timezone = $vals['usertimezone'];

            // Create dateselector element with different timezones.
            $elparams = array('optional'=>false, 'timezone' => $vals['timezone']);
            $el = $this->mform->addElement('date_time_selector', 'dateselector', null, $elparams);
            $this->assertTrue($el instanceof MoodleQuickForm_date_time_selector);
            $expectedvalues = array(
                'day' => array($vals['day']),
                'month' => array($vals['month']),
                'year' => array($vals['year']),
                'hour' => array($vals['hour']),
                'minute' => array($vals['minute'])
                );
            $mform->_submitValues = array('dateselector' => $vals['timestamp']);
            $el->onQuickFormEvent('updateValue', null, $mform);
            $this->assertSame($expectedvalues, $el->getValue());
        }
    }
}

/**
 * Form object to be used in test case
 */
class temp_form_datetime extends moodleform {
    /**
     * Form definition.
     */
    public function definition() {
        // No definition required.
    }
    /**
     * Returns form reference.
     * @return MoodleQuickForm
     */
    public function getform() {
        $mform = $this->_form;
        // set submitted flag, to simulate submission
        $mform->_flagSubmitted = true;
        return $mform;
    }
}
