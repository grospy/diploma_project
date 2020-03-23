<?php
//

/**
 * Unit tests for /lib/filestorage/mbz_packer.php.
 *
 * @package core_files
 * @copyright 2013 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/filestorage/file_progress.php');

class core_files_mbz_packer_testcase extends advanced_testcase {

    public function test_archive_with_both_options() {
        global $CFG;
        $this->resetAfterTest();

        // Get backup packer.
        $packer = get_file_packer('application/vnd.moodle.backup');
        require_once($CFG->dirroot . '/lib/filestorage/tgz_packer.php');

        // Set up basic archive contents.
        $files = array('1.txt' => array('frog'));

        // Create 2 archives (each with one file in) in zip mode.
        $CFG->usezipbackups = true;
        $filefalse = $CFG->tempdir . '/false.mbz';
        $this->assertNotEmpty($packer->archive_to_pathname($files, $filefalse));
        $context = context_system::instance();
        $this->assertNotEmpty($storagefalse = $packer->archive_to_storage(
                $files, $context->id, 'phpunit', 'data', 0, '/', 'false.mbz'));

        // Create 2 archives in tgz mode.
        $CFG->usezipbackups = false;
        $filetrue = $CFG->tempdir . '/true.mbz';
        $this->assertNotEmpty($packer->archive_to_pathname($files, $filetrue));
        $context = context_system::instance();
        $this->assertNotEmpty($storagetrue = $packer->archive_to_storage(
                $files, $context->id, 'phpunit', 'data', 0, '/', 'true.mbz'));

        // Check the sizes are different (indicating different formats).
        $this->assertNotEquals(filesize($filefalse), filesize($filetrue));
        $this->assertNotEquals($storagefalse->get_filesize(), $storagetrue->get_filesize());

        // Extract files into storage and into filesystem from both formats.

        // Extract to path (zip).
        $packer->extract_to_pathname($filefalse, $CFG->tempdir);
        $onefile = $CFG->tempdir . '/1.txt';
        $this->assertEquals('frog', file_get_contents($onefile));
        unlink($onefile);

        // Extract to path (tgz).
        $packer->extract_to_pathname($filetrue, $CFG->tempdir);
        $onefile = $CFG->tempdir . '/1.txt';
        $this->assertEquals('frog', file_get_contents($onefile));
        unlink($onefile);

        // Extract to storage (zip).
        $packer->extract_to_storage($storagefalse, $context->id, 'phpunit', 'data', 1, '/');
        $fs = get_file_storage();
        $out = $fs->get_file($context->id, 'phpunit', 'data', 1, '/', '1.txt');
        $this->assertNotEmpty($out);
        $this->assertEquals('frog', $out->get_content());

        // Extract to storage (tgz).
        $packer->extract_to_storage($storagetrue, $context->id, 'phpunit', 'data', 2, '/');
        $out = $fs->get_file($context->id, 'phpunit', 'data', 2, '/', '1.txt');
        $this->assertNotEmpty($out);
        $this->assertEquals('frog', $out->get_content());
    }

    public function usezipbackups_provider() {
        return [
            'Use zips'  => [true],
            'Use tgz'   => [false],
        ];
    }

    /**
     * @dataProvider usezipbackups_provider
     */
    public function test_extract_to_pathname_returnvalue_successful($usezipbackups) {
        global $CFG;
        $this->resetAfterTest();

        $packer = get_file_packer('application/vnd.moodle.backup');

        // Set up basic archive contents.
        $files = array('1.txt' => array('frog'));

        // Create 2 archives (each with one file in) in zip mode.
        $CFG->usezipbackups = $usezipbackups;

        $mbzfile = make_request_directory() . '/file.mbz';
        $packer->archive_to_pathname($files, $mbzfile);

        $target = make_request_directory();
        $result = $packer->extract_to_pathname($mbzfile, $target, null, null, true);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider usezipbackups_provider
     */
    public function test_extract_to_pathname_returnvalue_failure($usezipbackups) {
        global $CFG;
        $this->resetAfterTest();

        $packer = get_file_packer('application/vnd.moodle.backup');

        // Create 2 archives (each with one file in) in zip mode.
        $CFG->usezipbackups = $usezipbackups;

        $mbzfile = make_request_directory() . '/file.mbz';
        file_put_contents($mbzfile, 'Content');

        $target = make_request_directory();
        $result = $packer->extract_to_pathname($mbzfile, $target, null, null, true);
        $this->assertDebuggingCalledCount(1);
        $this->assertFalse($result);
    }
}
