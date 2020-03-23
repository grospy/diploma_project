<?php
//

/**
 * User competency grade rated in course event.
 *
 * @package    core_competency
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

use core\event\base;
use core_competency\user_competency_course;
use context_course;
defined('MOODLE_INTERNAL') || die();

/**
 * User competency grade rated in course event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int competencyid: id of competency.
 *      - int grade: grade name of the user competency
 * }
 *
 * @package    core_competency
 * @since      Moodle 3.1
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_user_competency_rated_in_course extends base {

    /**
     * Convenience method to instantiate the event.
     *
     * @param user_competency_course $usercompetencycourse The user competency course.
     * @return self
     */
    public static function create_from_user_competency_course(user_competency_course $usercompetencycourse) {
        if (!$usercompetencycourse->get('id')) {
            throw new \coding_exception('The user competency course ID must be set.');
        }

        $params = array(
            'objectid' => $usercompetencycourse->get('id'),
            'relateduserid' => $usercompetencycourse->get('userid'),
            'other' => array(
                'competencyid' => $usercompetencycourse->get('competencyid'),
                'grade' => $usercompetencycourse->get('grade')
            )
        );
        $coursecontext = context_course::instance($usercompetencycourse->get('courseid'));
        $params['contextid'] = $coursecontext->id;
        $params['courseid'] = $usercompetencycourse->get('courseid');

        $event = static::create($params);
        $event->add_record_snapshot(user_competency_course::TABLE, $usercompetencycourse->to_record());
        return $event;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' rated the user competency with id '$this->objectid' with "
                . "'" . $this->other['grade'] . "' rating "
                . "in course with id '$this->courseid'";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventusercompetencyratedincourse', 'core_competency');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return \core_competency\url::user_competency_in_course($this->relateduserid, $this->other['competencyid'],
            $this->courseid);
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = user_competency_course::TABLE;
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
        if (!isset($this->other) || !isset($this->other['competencyid'])) {
            throw new \coding_exception('The \'competencyid\' value must be set.');
        }

        if (!$this->courseid) {
            throw new \coding_exception('The \'courseid\' value must be set.');
        }

        if (!$this->relateduserid) {
            throw new \coding_exception('The \'relateduserid\' value must be set.');
        }

        if (!isset($this->other['grade'])) {
            throw new \coding_exception('The \'grade\' value must be set.');
        }
    }

}
