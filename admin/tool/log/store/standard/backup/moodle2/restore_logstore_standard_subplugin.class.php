<?php
//

/**
 * Restore implementation for the (tool_log) logstore_standard subplugin.
 *
 * @package    logstore_standard
 * @category   backup
 * @copyright  2015 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class restore_logstore_standard_subplugin extends restore_tool_log_logstore_subplugin {

    /**
     * Returns the subplugin structure to attach to the 'logstore' XML element.
     *
     * @return restore_path_element[] array of elements to be processed on restore.
     */
    protected function define_logstore_subplugin_structure() {

        // If the logstore is not enabled we don't add structures for it.
        $enabledlogstores = explode(',', get_config('tool_log', 'enabled_stores'));
        if (!in_array('logstore_standard', $enabledlogstores)) {
            return array(); // The logstore is not enabled, nothing to restore.
        }

        $paths = array();

        $elename = $this->get_namefor('log');
        $elepath = $this->get_pathfor('/logstore_standard_log');
        $paths[] = new restore_path_element($elename, $elepath);

        return $paths;
    }

    /**
     * Process logstore_standard_log entries.
     *
     * This method proceeds to read, complete, remap and, finally,
     * discard or save every log entry.
     *
     * @param array() $data log entry.
     */
    public function process_logstore_standard_log($data) {
        global $DB;

        $data = $this->process_log($data, get_config('logstore_standard', 'jsonformat'));

        if ($data) {
            $DB->insert_record('logstore_standard_log', $data);
        }
    }
}
