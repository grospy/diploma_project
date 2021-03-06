<?php
//

/**
 * Questions exported event.
 *
 * @package    core
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Question category exported event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int categoryid: The ID of the category where the question resides
 *      - string format: The format of file export
 * }
 *
 * @package    core
 * @since      Moodle 3.7
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class questions_exported extends question_base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventquestionsexported', 'question');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' exported questions in '" . $this->other['format'] .
                "' format from the category with id '" . $this->other['categoryid'] . "'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        if ($this->courseid) {
            $cat = $this->other['categoryid'] . ',' . $this->contextid;
            if ($this->contextlevel == CONTEXT_MODULE) {
                return new \moodle_url('/question/edit.php', ['cmid' => $this->contextinstanceid, 'cat' => $cat]);
            }
            return new \moodle_url('/question/edit.php', ['courseid' => $this->courseid, 'cat' => $cat]);
        }
        return new \moodle_url('/question/category.php', ['courseid' => SITEID, 'edit' => $this->other['categoryid']]);
    }

    /**
     * Custom validations.
     *
     * other['categoryid'] and other['format'] is required.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['format'])) {
            throw new \coding_exception('The \'format\' must be set in \'other\'.');
        }
    }

    /**
     * Returns DB mappings used with backup / restore.
     * This is needed to override the function in question_base
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        // No mappings.
        return [];
    }

}
