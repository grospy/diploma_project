<?php
//

/**
 * Log storage reader interface.
 *
 * @package    core
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\log;

defined('MOODLE_INTERNAL') || die();

interface reader {
    /**
     * Localised name of the reader.
     *
     * To be used in selection for in reports.
     *
     * @return string
     */
    public function get_name();

    /**
     * Longer description of the log data source.
     * @return string
     */
    public function get_description();

    /**
     * Are the new events appearing in the reader?
     *
     * @return bool true means new log events are being added, false means no new data will be added
     */
    public function is_logging();
}
