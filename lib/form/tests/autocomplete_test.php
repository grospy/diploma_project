<?php
//

/**
 * Unit tests for autocomplete forms element.
 *
 * This file contains all unit test related to autocomplete forms element.
 *
 * @package    core_form
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/form/autocomplete.php');

/**
 * Unit tests for MoodleQuickForm_autocomplete
 *
 * Contains test cases for testing MoodleQuickForm_autocomplete
 *
 * @package    core_form
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_form_autocomplete_testcase extends basic_testcase {
    /**
     * Testcase for validation
     */
    public function test_validation() {
        // A default select with single values validates the data.
        $options = array('1' => 'One', 2 => 'Two');
        $element = new MoodleQuickForm_autocomplete('testel', null, $options);
        $submission = array('testel' => 2);
        $this->assertEquals($element->exportValue($submission), 2);
        $submission = array('testel' => 3);
        $this->assertEquals('', $element->exportValue($submission));

        // A select with multiple values validates the data.
        $options = array('1' => 'One', 2 => 'Two');
        $element = new MoodleQuickForm_autocomplete('testel', null, $options, array('multiple'=>'multiple'));
        $submission = array('testel' => array(2, 3));
        $this->assertEquals($element->exportValue($submission), array(2));

        // A select where the values are fetched via ajax does not validate the data.
        $element = new MoodleQuickForm_autocomplete('testel', null, array(), array('multiple'=>'multiple', 'ajax'=>'anything'));
        $submission = array('testel' => array(2, 3));
        $this->assertEquals($element->exportValue($submission), array(2, 3));

        // A select with single value without anything selected.
        $options = array('1' => 'One', 2 => 'Two');
        $element = new MoodleQuickForm_autocomplete('testel', null, $options);
        $submission = array();
        $this->assertEquals('', $element->exportValue($submission));

        // A select with multiple values without anything selected.
        $options = array('1' => 'One', 2 => 'Two');
        $element = new MoodleQuickForm_autocomplete('testel', null, $options, array('multiple' => 'multiple'));
        $submission = array();
        $this->assertEquals([], $element->exportValue($submission));
    }

}
