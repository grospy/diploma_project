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

require_once(__DIR__ . '/test_target_shortname.php');

/**
 * Test target.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_target_course_level_shortname extends test_target_shortname {

    /**
     * get_analyser_class
     *
     * @return string
     */
    public function get_analyser_class() {
        return '\core\analytics\analyser\courses';
    }
}
