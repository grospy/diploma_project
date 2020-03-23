<?php
//

/**
 * JSON data format writer
 *
 * @package    dataformat_json
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace dataformat_json;

defined('MOODLE_INTERNAL') || die();

/**
 * JSON data format writer
 *
 * @package    dataformat_json
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class writer extends \core\dataformat\base {

    /** @var $mimetype */
    public $mimetype = "application/json";

    /** @var $extension */
    public $extension = ".json";

    /** @var $sheetstarted */
    public $sheetstarted = false;

    /** @var $sheetdatadded */
    public $sheetdatadded = false;

    /**
     * Write the start of the file.
     */
    public function start_output() {
        echo "[";
    }

    /**
     * Write the start of the sheet we will be adding data to.
     *
     * @param array $columns
     */
    public function start_sheet($columns) {
        if ($this->sheetstarted) {
            echo ",";
        } else {
            $this->sheetstarted = true;
        }
        $this->sheetdatadded = false;
        echo "[";
    }

    /**
     * Write a single record
     *
     * @param array $record
     * @param int $rownum
     */
    public function write_record($record, $rownum) {
        if ($this->sheetdatadded) {
            echo ",";
        }

        echo json_encode($record, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $this->sheetdatadded = true;
    }

    /**
     * Write the end of the sheet containing the data.
     *
     * @param array $columns
     */
    public function close_sheet($columns) {
        echo "]";
    }

    /**
     * Write the end of the file.
     */
    public function close_output() {
        echo "]";
    }
}
