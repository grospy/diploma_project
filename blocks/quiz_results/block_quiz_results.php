<?php
//

/**
 * Classes to enforce the various access rules that can apply to a quiz.
 *
 * @package    block_quiz_results
 * @copyright  2009 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/lib.php');

/**
 * Block quiz_results class definition.
 *
 * This block can be added to a course page or a quiz page to display of list of
 * the best/worst students/groups in a particular quiz.
 *
 * @package    block_quiz_results
 * @copyright  2009 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_quiz_results extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_quiz_results');
    }

    function applicable_formats() {
        return array('mod-quiz' => true);
    }

    function instance_config_save($data, $nolongerused = false) {
        parent::instance_config_save($data);
    }

    function get_content() {
        return $this->content;
    }

    function instance_allow_multiple() {
        return true;
    }
}


