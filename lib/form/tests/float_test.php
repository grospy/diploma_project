<?php
//

/**
 * Unit tests for float form element.
 *
 * @package    core_form
 * @category   test
 * @copyright  2019 Shamim Rezaie <shamim@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/form/float.php');

/**
 * Unit tests for MoodleQuickForm_float
 *
 * Contains test cases for testing MoodleQuickForm_float
 *
 * @package    core_form
 * @copyright  2019 Shamim Rezaie <shamim@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_form_float_testcase extends advanced_testcase {

    /**
     * Define a local decimal separator.
     *
     * It is not possible to directly change the result of get_string in
     * a unit test. Instead, we create a language pack for language 'xx' in
     * dataroot and make langconfig.php with the string we need to change.
     * The example separator used here is 'X'.
     */
    protected function define_local_decimal_separator() {
        global $SESSION, $CFG;

        $SESSION->lang = 'xx';
        $langconfig = "<?php\n\$string['decsep'] = 'X';";
        $langfolder = $CFG->dataroot . '/lang/xx';
        check_dir_exists($langfolder);
        file_put_contents($langfolder . '/langconfig.php', $langconfig);
    }

    /**
     * Testcase to check generated timestamp
     */
    public function test_exportValue() {
        $element = new MoodleQuickForm_float('testel');

        $value = ['testel' => 3.14];
        $this->assertEquals(3.14, $element->exportValue($value));

        $value = ['testel' => '3.14'];
        $this->assertEquals(3.14, $element->exportValue($value));

        $value = ['testel' => '-3.14'];
        $this->assertEquals(-3.14, $element->exportValue($value));

        $value = ['testel' => '3.14blah'];
        $this->assertEquals(false, $element->exportValue($value));

        $value = ['testel' => 'blah'];
        $this->assertEquals(false, $element->exportValue($value));

        // Tests with a localised decimal separator.
        $this->define_local_decimal_separator();

        $value = ['testel' => 3.14];
        $this->assertEquals(3.14, $element->exportValue($value));

        $value = ['testel' => '3X14'];
        $this->assertEquals(3.14, $element->exportValue($value));

        $value = ['testel' => '-3X14'];
        $this->assertEquals(-3.14, $element->exportValue($value));

        $value = ['testel' => '3X14blah'];
        $this->assertEquals(false, $element->exportValue($value));

        $value = ['testel' => 'blah'];
        $this->assertEquals(false, $element->exportValue($value));
    }
}