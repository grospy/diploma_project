<?php
//

/**
 * Table log for generating data in ajax mode.
 *
 * @package    report_loglive
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Table log class for generating data in ajax mode.
 *
 * @since      Moodle 2.7
 * @package    report_loglive
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_loglive_table_log_ajax extends report_loglive_table_log {

    /**
     * Convenience method to call a number of methods for you to display the
     * table.
     *
     * @param int $pagesize pagesize
     * @param bool $useinitialsbar Not used, present only for compatibility with parent.
     * @param string $downloadhelpbutton Not used, present only for compatibility with parent.
     *
     * @return string json encoded data containing html of new rows.
     */
    public function out($pagesize, $useinitialsbar, $downloadhelpbutton = '') {
        $this->query_db($pagesize, false);
        $html = '';
        $until = time();
        if ($this->rawdata && $this->columns) {
            foreach ($this->rawdata as $row) {
                $formatedrow = $this->format_row($row, "newrow time$until");
                $formatedrow = $this->get_row_from_keyed($formatedrow);
                $html .= $this->get_row_html($formatedrow, "newrow time$until");
            }
        }
        $result = array('logs' => $html, 'until' => $until);
        return json_encode($result);
    }
}
