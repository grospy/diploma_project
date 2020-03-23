<?php
//

/**
 * Provides \antivirus_testable class.
 *
 * @package     core
 * @subpackage  fixtures
 * @category    test
 * @copyright   2016 Ruslan Kabalin, Lancaster University.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace antivirus_testable;

defined('MOODLE_INTERNAL') || die();

/**
 * Testable antivirus plugin.
 *
 * @copyright   2016 Ruslan Kabalin, Lancaster University.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class scanner extends \core\antivirus\scanner {
    /**
     * Are the necessary antivirus settings configured?
     *
     * @return bool True if all necessary config settings been entered
     */
    public function is_configured() {
        return true;
    }

    /**
     * Scan file.
     *
     * Provides fake responses for testing \core\antivirus\manager.
     *
     * @param string $file Full path to the file.
     * @param string $filename For mocking purposes, filename defines expected response.
     * @return int Scanning result constant.
     */
    public function scan_file($file, $filename) {
        switch ($filename) {
            case 'OK':
                return self::SCAN_RESULT_OK;
            case 'FOUND':
                return self::SCAN_RESULT_FOUND;
            case 'ERROR':
                return self::SCAN_RESULT_ERROR;
            default:
                debugging('$filename should be either OK, FOUND or ERROR.');
                break;
        }
    }

    /**
     * Scan data.
     *
     * Provides fake responses for testing \core\antivirus\manager.
     *
     * @param string $data The variable containing the data to scan.
     * @return int Scanning result constant.
     */
    public function scan_data($data) {
        switch ($data) {
            case 'OK':
                return self::SCAN_RESULT_OK;
            case 'FOUND':
                return self::SCAN_RESULT_FOUND;
            case 'ERROR':
                return self::SCAN_RESULT_ERROR;
            default:
                debugging('$data should be either OK, FOUND or ERROR.');
                break;
        }
    }
}
