<?php
//

/**
 * Feedback block.
 *
 * @package    block_feedback
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/feedback/lib.php');

class block_feedback extends block_list {

    function init() {
        $this->title = get_string('feedback', 'block_feedback');
    }

    function applicable_formats() {
        return array('site' => true, 'course' => true);
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $courseid = $this->page->course->id;
        if ($courseid <= 0) {
            $courseid = SITEID;
        }

        $icon = $OUTPUT->image_icon('icon', get_string('pluginname', 'mod_feedback'), 'mod_feedback');

        if (empty($this->instance->pageid)) {
            $this->instance->pageid = SITEID;
        }

        if ($feedbacks = feedback_get_feedbacks_from_sitecourse_map($courseid)) {
            $baseurl = new moodle_url('/mod/feedback/view.php');
            foreach ($feedbacks as $feedback) {
                $url = new moodle_url($baseurl);
                $url->params(array('id'=>$feedback->cmid, 'courseid'=>$courseid));
                $this->content->items[] = '<a href="'.$url->out().'">'.$icon.$feedback->name.'</a>';
            }
        }

        return $this->content;
    }
}
