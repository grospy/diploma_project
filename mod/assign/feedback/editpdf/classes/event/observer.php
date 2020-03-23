<?php
//

/**
 * An event observer.
 *
 * @package    assignfeedback_editpdf
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace assignfeedback_editpdf\event;

/**
 * An event observer.
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {

    /**
     * Listen to events and queue the submission for processing.
     * @param \mod_assign\event\submission_created $event
     */
    public static function submission_created(\mod_assign\event\submission_created $event) {
        self::queue_conversion($event);
    }

    /**
     * Listen to events and queue the submission for processing.
     * @param \mod_assign\event\submission_updated $event
     */
    public static function submission_updated(\mod_assign\event\submission_updated $event) {
        self::queue_conversion($event);
    }

    /**
     * Queue the submission for processing.
     * @param \mod_assign\event\base $event The submission created/updated event.
     */
    protected static function queue_conversion($event) {
        global $DB;

        $submissionid = $event->other['submissionid'];
        $submissionattempt = $event->other['submissionattempt'];
        $fields = array( 'submissionid' => $submissionid, 'submissionattempt' => $submissionattempt);
        $record = (object) $fields;

        $exists = $DB->get_record('assignfeedback_editpdf_queue', $fields);
        if (!$exists) {
            $DB->insert_record('assignfeedback_editpdf_queue', $record);
        } else {
            // This submission attempt was already queued, so just reset the existing failure counter to ensure it gets processed.
            $exists->attemptedconversions = 0;
            $DB->update_record('assignfeedback_editpdf_queue', $exists);
        }
    }
}
