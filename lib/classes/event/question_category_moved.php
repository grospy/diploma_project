<?php
//

/**
 * Question category moved event.
 *
 * @package    core
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Question category moved event class.
 *
 * @package    core
 * @since      Moodle 3.7
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_category_moved extends question_category_base {

    /**
     * Init method.
     */
    protected function init() {
        parent::init();
        $this->data['crud'] = 'u';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventquestioncategorymoved', 'question');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' moved the question category with id '$this->objectid'.";
    }

}
