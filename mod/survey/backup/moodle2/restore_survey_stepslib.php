<?php

//

/**
 * @package    mod_survey
 * @subpackage backup-moodle2
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Define all the restore steps that will be used by the restore_survey_activity_task
 */

/**
 * Structure step to restore one survey activity
 */
class restore_survey_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {

        $paths = array();
        $userinfo = $this->get_setting_value('userinfo');

        $paths[] = new restore_path_element('survey', '/activity/survey');
        if ($userinfo) {
            $paths[] = new restore_path_element('survey_answer', '/activity/survey/answers/answer');
            $paths[] = new restore_path_element('survey_analys', '/activity/survey/analysis/analys');
        }

        // Return the paths wrapped into standard activity structure
        return $this->prepare_activity_structure($paths);
    }

    protected function process_survey($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        // Any changes to the list of dates that needs to be rolled should be same during course restore and course reset.
        // See MDL-9367.

        // insert the survey record
        $newitemid = $DB->insert_record('survey', $data);
        // immediately after inserting "activity" record, call this
        $this->apply_activity_instance($newitemid);
    }

    protected function process_survey_analys($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->survey = $this->get_new_parentid('survey');
        $data->userid = $this->get_mappingid('user', $data->userid);

        $newitemid = $DB->insert_record('survey_analysis', $data);
        // No need to save this mapping as far as nothing depend on it
        // (child paths, file areas nor links decoder)
    }

    protected function process_survey_answer($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->survey = $this->get_new_parentid('survey');
        $data->userid = $this->get_mappingid('user', $data->userid);

        $newitemid = $DB->insert_record('survey_answers', $data);
        // No need to save this mapping as far as nothing depend on it
        // (child paths, file areas nor links decoder)
    }

    protected function after_execute() {
        // Add survey related files, no need to match by itemname (just internally handled context)
        $this->add_related_files('mod_survey', 'intro', null);
    }
}
