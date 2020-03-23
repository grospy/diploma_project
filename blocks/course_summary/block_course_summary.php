<?php
//

/**
 * Course summary block
 *
 * @package    block_course_summary
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_course_summary extends block_base {

    /**
     * @var bool Flag to indicate whether the header should be hidden or not.
     */
    private $headerhidden = true;

    function init() {
        $this->title = get_string('pluginname', 'block_course_summary');
    }

    function applicable_formats() {
        return array('all' => true, 'mod' => false, 'tag' => false, 'my' => false);
    }

    function specialization() {
        // Page type starts with 'course-view' and the page's course ID is not equal to the site ID.
        if (strpos($this->page->pagetype, PAGE_COURSE_VIEW) === 0 && $this->page->course->id != SITEID) {
            $this->title = get_string('coursesummary', 'block_course_summary');
            $this->headerhidden = false;
        }
    }

    function get_content() {
        global $CFG, $OUTPUT;

        require_once($CFG->libdir . '/filelib.php');

        if($this->content !== NULL) {
            return $this->content;
        }

        if (empty($this->instance)) {
            return '';
        }

        $this->content = new stdClass();
        $options = new stdClass();
        $options->noclean = true;    // Don't clean Javascripts etc
        $options->overflowdiv = true;
        $context = context_course::instance($this->page->course->id);
        $this->page->course->summary = file_rewrite_pluginfile_urls($this->page->course->summary, 'pluginfile.php', $context->id, 'course', 'summary', NULL);
        $this->content->text = format_text($this->page->course->summary, $this->page->course->summaryformat, $options);
        $this->content->footer = '';

        return $this->content;
    }

    function hide_header() {
        return $this->headerhidden;
    }

}


