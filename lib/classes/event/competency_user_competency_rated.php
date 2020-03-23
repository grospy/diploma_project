<?php
//

/**
 * User competency grade rated event.
 *
 * @package    core_competency
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

use core\event\base;
use core_competency\user_competency;
defined('MOODLE_INTERNAL') || die();

/**
 * User competency grade rated event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int grade: grade name of the user competency
 * }
 *
 * @package    core_competency
 * @since      Moodle 3.1
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_user_competency_rated extends base {

    /**
     * Convenience method to instantiate the event.
     *
     * @param user_competency $usercompetency The user competency.
     * @return self
     */
    public static function create_from_user_competency(user_competency $usercompetency) {
        if (!$usercompetency->get('id')) {
            throw new \coding_exception('The user competency ID must be set.');
        }

        $params = array(
            'contextid' => $usercompetency->get_context()->id,
            'objectid' => $usercompetency->get('id'),
            'relateduserid' => $usercompetency->get('userid'),
            'other' => array(
                'grade' => $usercompetency->get('grade')
            )
        );

        $event = static::create($params);
        $event->add_record_snapshot(user_competency::TABLE, $usercompetency->to_record());
        return $event;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' rated the user competency with id '$this->objectid' "
                . "with '" . $this->other['grade'] . "' rating";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventusercompetencyrated', 'core_competency');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return \core_competency\url::user_competency($this->objectid);
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = user_competency::TABLE;
    }

    /**
     * Get_objectid_mapping method.
     *
     * @return string the name of the restore mapping the objectid links to
     */
    public static function get_objectid_mapping() {
        return base::NOT_MAPPED;
    }

    /**
     * Custom validation.
     *
     * Throw \coding_exception notice in case of any problems.
     */
    protected function validate_data() {
        if (!$this->relateduserid) {
            throw new \coding_exception('The \'relateduserid\' value must be set.');
        }

        if (!isset($this->other) || !isset($this->other['grade'])) {
            throw new \coding_exception('The \'grade\' value must be set.');
        }
    }

}
