<?php
//

/**
 * Tests for antivirus manager.
 *
 * @package    core_antivirus
 * @category   phpunit
 * @copyright  2016 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once(__DIR__ . '/fixtures/testable_antivirus.php');

class core_antivirus_testcase extends advanced_testcase {
    protected $tempfile;

    protected function setUp() {
        global $CFG;
        // Use our special testable fixture plugin.
        $CFG->antiviruses = 'testable';

        $this->resetAfterTest();

        // Create tempfile.
        $tempfolder = make_request_directory(false);
        $this->tempfile = $tempfolder . '/' . rand();
        touch($this->tempfile);
    }

    protected function tearDown() {
        @unlink($this->tempfile);
    }

    public function test_manager_get_antivirus() {
        // We are using clamav plugin in the test,
        // as the only plugin we know exists for sure.
        $antivirusviaget = \core\antivirus\manager::get_antivirus('clamav');
        $antivirusdirect = new \antivirus_clamav\scanner();
        $this->assertEquals($antivirusdirect, $antivirusviaget);
    }

    public function test_manager_scan_file_no_virus() {
        // Run mock scanning.
        $this->assertFileExists($this->tempfile);
        $this->assertEmpty(\core\antivirus\manager::scan_file($this->tempfile, 'OK', true));
        // File expected to remain in place.
        $this->assertFileExists($this->tempfile);
    }

    public function test_manager_scan_file_error() {
        // Run mock scanning.
        $this->assertFileExists($this->tempfile);
        $this->assertEmpty(\core\antivirus\manager::scan_file($this->tempfile, 'ERROR', true));
        // File expected to remain in place.
        $this->assertFileExists($this->tempfile);
    }

    public function test_manager_scan_file_virus() {
        // Run mock scanning without deleting infected file.
        $this->assertFileExists($this->tempfile);
        $this->expectException(\core\antivirus\scanner_exception::class);
        $this->assertEmpty(\core\antivirus\manager::scan_file($this->tempfile, 'FOUND', false));
        // File expected to remain in place.
        $this->assertFileExists($this->tempfile);

        // Run mock scanning with deleting infected file.
        $this->expectException(\core\antivirus\scanner_exception::class);
        $this->assertEmpty(\core\antivirus\manager::scan_file($this->tempfile, 'FOUND', true));
        // File expected to be deleted.
        $this->assertFileNotExists($this->tempfile);
    }

    public function test_manager_scan_data_no_virus() {
        // Run mock scanning.
        $this->assertEmpty(\core\antivirus\manager::scan_data('OK'));
    }

    public function test_manager_scan_data_error() {
        // Run mock scanning.
        $this->assertEmpty(\core\antivirus\manager::scan_data('ERROR'));
    }

    public function test_manager_scan_data_virus() {
        // Run mock scanning.
        $this->expectException(\core\antivirus\scanner_exception::class);
        $this->assertEmpty(\core\antivirus\manager::scan_data('FOUND'));
    }
}
