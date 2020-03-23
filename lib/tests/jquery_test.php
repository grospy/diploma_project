<?php
//

/**
 * Test jQuery integration.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * This is not a complete jquery test, it just validates
 * Moodle integration is set up properly.
 *
 * Launch http://127.0.0.1/lib/tests/other/jquerypage.php to
 * verify it actually works in browser.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_jquery_testcase extends basic_testcase {

    public function test_plugins_file() {
        global $CFG;

        $plugins = null;
        require($CFG->libdir . '/jquery/plugins.php');
        $this->assertInternalType('array', $plugins);
        $this->assertEquals(array('jquery', 'ui', 'ui-css'), array_keys($plugins));

        foreach ($plugins as $type => $files) {
            foreach ($files['files'] as $file) {
                $this->assertFileExists($CFG->libdir . '/jquery/' . $file);
            }
        }
    }
}
