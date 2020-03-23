<?php
//

/**
 * Backup implementation for the (tool_log) logstore_standard subplugin.
 *
 * @package    logstore_standard
 * @category   backup
 * @copyright  2015 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class backup_logstore_standard_subplugin extends backup_tool_log_logstore_subplugin {

    /**
     * Returns the subplugin structure to attach to the 'logstore' XML element.
     *
     * @return backup_subplugin_element the subplugin structure to be attached.
     */
    protected function define_logstore_subplugin_structure() {

        $subplugin = $this->get_subplugin_element();
        $subpluginwrapper = new backup_nested_element($this->get_recommended_name());

        // Create the custom (base64 encoded, xml safe) 'other' final element.
        $otherelement = new base64_encode_final_element('other');

        $subpluginlog = new backup_nested_element('logstore_standard_log', array('id'), array(
            'eventname', 'component', 'action', 'target', 'objecttable',
            'objectid', 'crud', 'edulevel', 'contextid', 'userid', 'relateduserid',
            'anonymous', $otherelement, 'timecreated', 'ip', 'realuserid'));

        $subplugin->add_child($subpluginwrapper);
        $subpluginwrapper->add_child($subpluginlog);

        $subpluginlog->set_source_table('logstore_standard_log', array('contextid' => backup::VAR_CONTEXTID));

        return $subplugin;
    }
}
