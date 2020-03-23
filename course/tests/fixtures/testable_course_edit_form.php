<?php
//

/**
 * Testable course edit form.
 *
 * @package    core_course
 * @category   test
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/course/edit_form.php');

/**
 * Testable course edit form.
 *
 * @package    core_course
 * @category   test
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_course_edit_form extends course_edit_form {

    /**
     * Expose the internal moodleform's MoodleQuickForm
     *
     * @return MoodleQuickForm
     */
    public function get_quick_form() {
        return $this->_form;
    }
}
