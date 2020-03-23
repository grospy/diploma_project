<?php
//

/**
 * Search area for sent messages.
 *
 * @package    core_message
 * @copyright  2016 Devang Gaur
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_message\search;

defined('MOODLE_INTERNAL') || die();

/**
 * Search area for sent messages.
 *
 * @package    core_message
 * @copyright  2016 Devang Gaur
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_sent extends base_message {

    /**
     * Returns a recordset with the messages for indexing.
     *
     * @param int $modifiedfrom
     * @param \context|null $context Optional context to restrict scope of returned results
     * @return moodle_recordset|null Recordset (or null if no results)
     */
    public function get_document_recordset($modifiedfrom = 0, \context $context = null) {
        return $this->get_document_recordset_helper($modifiedfrom, $context, 'useridfrom');
    }

    /**
     * Returns the document associated with this message record.
     *
     * @param stdClass $record
     * @param array    $options
     * @return \core_search\document
     */
    public function get_document($record, $options = array()) {
        return parent::get_document($record, array('user1id' => $record->useridfrom, 'user2id' => $record->useridto));
    }

    /**
     * Whether the user can access the document or not.
     *
     * @param int $id The message instance id.
     * @return int
     */
    public function check_access($id) {
        global $CFG, $DB, $USER;

        if (!$CFG->messaging) {
            return \core_search\manager::ACCESS_DENIED;
        }

        $sql = "SELECT m.*, mcm.userid as useridto
                  FROM {messages} m
            INNER JOIN {message_conversations} mc
                    ON m.conversationid = mc.id
            INNER JOIN {message_conversation_members} mcm
                    ON mcm.conversationid = mc.id
                 WHERE mcm.userid != m.useridfrom
                   AND m.id = :id";
        $message = $DB->get_record_sql($sql, array('id' => $id));
        if (!$message) {
            return \core_search\manager::ACCESS_DELETED;
        }

        $userfrom = \core_user::get_user($message->useridfrom, 'id, deleted');
        $userto = \core_user::get_user($message->useridto, 'id, deleted');

        if (!$userfrom || !$userto || $userfrom->deleted || $userto->deleted) {
            return \core_search\manager::ACCESS_DELETED;
        }

        if ($USER->id != $userfrom->id) {
            return \core_search\manager::ACCESS_DENIED;
        }

        $userfromdeleted = $DB->record_exists('message_user_actions', ['messageid' => $id, 'userid' => $message->useridfrom,
            'action' => \core_message\api::MESSAGE_ACTION_DELETED]);
        if ($userfromdeleted) {
            return \core_search\manager::ACCESS_DELETED;
        }

        return \core_search\manager::ACCESS_GRANTED;
    }

}
