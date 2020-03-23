<?php
//

/**
 * Question created event.
 *
 * @package    core
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Question created event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int categoryid: The ID of the category where the question resides
 * }
 *
 * @package    core
 * @since      Moodle 3.7
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_created extends question_base {

    /**
     * Init method.
     */
    protected function init() {
        parent::init();
        $this->data['crud'] = 'c';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventquestioncreated', 'question');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created a question with the id of '$this->objectid'" .
                " in the category with the id '" . $this->other['categoryid'] . "'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        if ($this->courseid) {
            if ($this->contextlevel == CONTEXT_MODULE) {
                return new \moodle_url('/question/preview.php', ['cmid' => $this->contextinstanceid, 'id' => $this->objectid]);
            }
            return new \moodle_url('/question/preview.php', ['courseid' => $this->courseid, 'id' => $this->objectid]);
        }
        // Lets try editing from the frontpage for contexts above course.
        return new \moodle_url('/question/preview.php', ['courseid' => SITEID, 'id' => $this->objectid]);
    }
}
