<?php
//

/**
 * Log storage sql internal table reader interface.
 *
 * @package    core
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\log;

defined('MOODLE_INTERNAL') || die();

/**
 * Sql internal table reader.
 *
 * Replaces sql_internal_reader and extends sql_reader.
 *
 * @since      Moodle 2.9
 * @package    core
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface sql_internal_table_reader extends sql_reader {

    /**
     * Returns name of the table or database view that
     * holds the log data in standardised format.
     *
     * Note: this table must be used for reading only,
     * it is strongly recommended to use this in complex reports only.
     *
     * @return string
     */
    public function get_internal_log_table_name();
}
