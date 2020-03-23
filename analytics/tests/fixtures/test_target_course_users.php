<?php
//

/**
 * Test target.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/test_target_site_users.php');

/**
 * Test target.
 *
 * @package   core_analytics
 * @copyright 2018 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_target_course_users extends test_target_site_users {

    /**
     * get_analyser_class
     *
     * @return string
     */
    public function get_analyser_class() {
        return '\core\analytics\analyser\student_enrolments';
    }

    /**
     * Returns a lang_string object representing the name for the indicator.
     *
     * Used as column identificator.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        // Using a string that exists and contains a corresponding '_help' string.
        return new \lang_string('adminhelpedituser');
    }
}
