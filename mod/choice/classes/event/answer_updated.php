<?php
//

/**
 * The mod_choice answer updated event.
 *
 * @package    mod_choice
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_choice\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_choice answer updated event class.
 *
 * This event is deprecated in Moodle 3.2, it can no longer be triggered, do not
 * write event observers for it. This event can only be initiated during
 * restore from previous Moodle versions and appear in the logs.
 *
 * Event observers should listen to mod_choice\event\answer_created and
 * mod_choice\event\answer_deleted instead, these events will be triggered for
 * each option that was user has selected or unselected
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int choiceid: id of choice.
 *      - int optionid: (optional) id of option.
 * }
 *
 * @deprecated since 3.2
 * @package    mod_choice
 * @since      Moodle 2.6
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class answer_updated extends \core\event\base {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated their choice with id '$this->objectid' in the choice activity
            with course module id '$this->contextinstanceid'.";
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        $legacylogdata = array($this->courseid,
            'choice',
            'choose again',
            'view.php?id=' . $this->contextinstanceid,
            $this->other['choiceid'],
            $this->contextinstanceid);

        return $legacylogdata;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventanswerupdated', 'mod_choice');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/choice/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        // The objecttable here is wrong. We are updating an answer, not a choice activity.
        // This also makes the description misleading as it states we made a choice with id
        // '$this->objectid' which just refers to the 'choice' table. The trigger for
        // this event should be triggered after we update the 'choice_answers' table.
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'choice';
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        debugging('Event \\mod_choice\event\\answer_updated should not be used '
                . 'any more for triggering new events and can only be initiated during restore. '
                . 'For new events please use \\mod_choice\\event\\answer_created '
                . 'and  \\mod_choice\\event\\answer_deleted', DEBUG_DEVELOPER);

        if (!isset($this->other['choiceid'])) {
            throw new \coding_exception('The \'choiceid\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'choice', 'restore' => 'choice');
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['choiceid'] = array('db' => 'choice', 'restore' => 'choice');

        // The 'optionid' is being passed as an array, so we can't map it. The event is
        // triggered each time a choice is answered, where it may be possible to select
        // multiple choices, so the value is converted to an array, which is then passed
        // to the event. Ideally this event should be triggered every time we update the
        // 'choice_answers' table so this will only be an int.
        $othermapped['optionid'] = \core\event\base::NOT_MAPPED;

        return $othermapped;
    }

    public static function is_deprecated() {
        return true;
    }
}
