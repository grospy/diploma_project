<?php
//

/**
 * Event for when a new note entry is added.
 *
 * @package    core
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Class note_created
 *
 * Class for event to be triggered when a note is created.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string publishstate: (optional) the publish state.
 * }
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class note_created extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['objecttable'] = 'post';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string("eventnotecreated", "core_notes");
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created the note with id '$this->objectid' for the user with id " .
            "'$this->relateduserid'.";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        $logurl = new \moodle_url('/notes/index.php', array('course' => $this->courseid, 'user' => $this->relateduserid));
        $logurl->set_anchor('note-' . $this->objectid);
        return $logurl;
    }

    /**
     * replace add_to_log() statement.
     *
     * @return array of parameters to be passed to legacy add_to_log() function.
     */
    protected function get_legacy_logdata() {
        $logurl = new \moodle_url('index.php', array('course' => $this->courseid, 'user' => $this->relateduserid));
        $logurl->set_anchor('note-' . $this->objectid);
        return array($this->courseid, 'notes', 'add', $logurl, 'add note');
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }
    }

    public static function get_objectid_mapping() {
        // Notes are not backed up, so no need to map on restore.
        return array('db' => 'post', 'restore' => base::NOT_MAPPED);
    }

    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
