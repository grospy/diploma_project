<?php

//

/**
 * @package    mod_folder
 * @subpackage backup-moodle2
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Define all the restore steps that will be used by the restore_folder_activity_task
 */

/**
 * Structure step to restore one folder activity
 */
class restore_folder_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {

        $paths = array();
        $paths[] = new restore_path_element('folder', '/activity/folder');

        // Return the paths wrapped into standard activity structure
        return $this->prepare_activity_structure($paths);
    }

    protected function process_folder($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        // Any changes to the list of dates that needs to be rolled should be same during course restore and course reset.
        // See MDL-9367.

        // If showexpanded is not set, apply site default.
        if (!isset($data->showexpanded)) {
            $data->showexpanded = get_config('folder', 'showexpanded');
        }

        // insert the folder record
        $newitemid = $DB->insert_record('folder', $data);
        // immediately after inserting "activity" record, call this
        $this->apply_activity_instance($newitemid);
    }

    protected function after_execute() {
        // Add folder related files, no need to match by itemname (just internally handled context)
        $this->add_related_files('mod_folder', 'intro', null);
        $this->add_related_files('mod_folder', 'content', null);
    }
}
