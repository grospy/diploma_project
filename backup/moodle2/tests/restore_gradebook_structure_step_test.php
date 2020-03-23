<?php
//

/**
 * Test for restore_stepslib.
 *
 * @package core_backup
 * @copyright 2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');
require_once($CFG->libdir . '/completionlib.php');

/**
 * Test for restore_stepslib.
 *
 * @package core_backup
 * @copyright 2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_backup_restore_gradebook_structure_step_testcase extends advanced_testcase {

    /**
     * Provide tests for rewrite_step_backup_file_for_legacy_freeze based upon fixtures.
     *
     * @return array
     */
    public function rewrite_step_backup_file_for_legacy_freeze_provider() {
        $fixturesdir = realpath(__DIR__ . '/fixtures/rewrite_step_backup_file_for_legacy_freeze/');
        $tests = [];
        $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($fixturesdir),
                \RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($iterator as $sourcefile) {
            $pattern = '/\.test$/';
            if (!preg_match($pattern, $sourcefile)) {
                continue;
            }

            $expectfile = preg_replace($pattern, '.expectation', $sourcefile);
            $test = array($sourcefile, $expectfile);
            $tests[basename($sourcefile)] = $test;
        }

        return $tests;
    }

    /**
     * @dataProvider rewrite_step_backup_file_for_legacy_freeze_provider
     * @param   string  $source     The source file to test
     * @param   string  $expected   The expected result of the transformation
     */
    public function test_rewrite_step_backup_file_for_legacy_freeze($source, $expected) {
        $restore = $this->getMockBuilder('\restore_gradebook_structure_step')
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock()
            ;

        // Copy the file somewhere as the rewrite_step_backup_file_for_legacy_freeze will write the file.
        $dir = make_request_directory(true);
        $filepath = $dir . DIRECTORY_SEPARATOR . 'file.xml';
        copy($source, $filepath);

        $rc = new \ReflectionClass('\restore_gradebook_structure_step');
        $rcm = $rc->getMethod('rewrite_step_backup_file_for_legacy_freeze');
        $rcm->setAccessible(true);
        $rcm->invoke($restore, $filepath);

        // Check the result.
        $this->assertFileEquals($expected, $filepath);
    }
}
