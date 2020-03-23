<?php
//

/**
 * Define all the restore steps that will be used by the restore_imscp_activity_task
 *
 * @package mod_imscp
 * @subpackage backup-moodle2
 * @copyright 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Structure step to restore one imscp activity
 *
 * @copyright 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_imscp_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {

        $paths = array();
        $paths[] = new restore_path_element('imscp', '/activity/imscp');

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    protected function process_imscp($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        // Any changes to the list of dates that needs to be rolled should be same during course restore and course reset.
        // See MDL-9367.

        // Insert the imscp record.
        $newitemid = $DB->insert_record('imscp', $data);
        // Immediately after inserting "activity" record, call this.
        $this->apply_activity_instance($newitemid);
    }

    protected function after_execute() {
        // Add imscp related files, no need to match by itemname (just internally handled context).
        // Eloy Lafuente: I don't like itemid used for "imaginative" things like "revisions"!
        $this->add_related_files('mod_imscp', 'intro', null);
        $this->add_related_files('mod_imscp', 'backup', null);
        $this->add_related_files('mod_imscp', 'content', null);
    }
}
