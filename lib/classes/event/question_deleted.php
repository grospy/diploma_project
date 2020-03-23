<?php
//

/**
 * Question deleted event.
 *
 * @package    core
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Question deleted event class.
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
class question_deleted extends question_base {

    /**
     * Init method.
     */
    protected function init() {
        parent::init();
        $this->data['crud'] = 'd';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventquestiondeleted', 'question');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the question with id '$this->objectid'" .
                " from the category with the id '" . $this->other['categoryid'] . "'.";
    }

    /**
     * Returns relevant URL.
     * This is needed to override the function in question_base
     *
     * @return \moodle_url
     */
    public function get_url() {
        // No URL for delete.
        return null;
    }
}
