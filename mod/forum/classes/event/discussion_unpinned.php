<?php
//
/**
 * The mod_forum discussion unpinned event.
 *
 * @package    mod_forum
 * @copyright  2014 Charles Fulton <fultonc@lafayette.edu>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_forum discussion unpinned event.
 *
 * @package    mod_forum
 * @copyright  2014 Charles Fulton <fultonc@lafayette.edu>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class discussion_unpinned extends \core\event\base {
    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'forum_discussions';
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user {$this->userid} has unpinned the discussion {$this->objectid} in the forum {$this->other['forumid']}";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventdiscussionunpinned', 'mod_forum');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/forum/discuss.php', array('d' => $this->objectid));
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        // The legacy log table expects a relative path to /mod/forum/.
        $logurl = substr($this->get_url()->out_as_local_url(), strlen('/mod/forum/'));
        return array($this->courseid, 'forum', 'unpin discussion', $logurl, $this->objectid, $this->contextinstanceid);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['forumid'])) {
            throw new \coding_exception('forumid must be set in $other.');
        }
        if ($this->contextlevel != CONTEXT_MODULE) {
            throw new \coding_exception('Context passed must be module context.');
        }
        if (!isset($this->objectid)) {
            throw new \coding_exception('objectid must be set to the discussionid.');
        }
    }

    /**
     * Forum discussion object id mappings.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return array('db' => 'forum_discussions', 'restore' => 'forum_discussion');
    }

    /**
     * Forum id mappings.
     *
     * @return array
     */
    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['forumid'] = array('db' => 'forum', 'restore' => 'forum');

        return $othermapped;
    }
}
