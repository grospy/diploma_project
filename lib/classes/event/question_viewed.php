<?php
//

/**
 * Question previewed event.
 *
 * @package    core
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Question previewed event class.
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
class question_viewed extends question_base {

    /**
     * Init method.
     */
    protected function init() {
        parent::init();
        $this->data['crud'] = 'r';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventquestionviewed', 'question');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed the question with the id of '$this->objectid'.";
    }

}
