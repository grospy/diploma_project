<?php
//

/**
 * Global search block.
 *
 * @package    block_globalsearch
 * @copyright  Prateek Sachan {@link http://prateeksachan.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Global search block.
 *
 * @package    block_globalsearch
 * @copyright  Prateek Sachan {@link http://prateeksachan.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_globalsearch extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_globalsearch');
    }

    /**
     * Gets the block contents.
     *
     * If we can avoid it better not check the server status here as connecting
     * to the server will slow down the whole page load.
     *
     * @return string The block HTML.
     */
    public function get_content() {
        global $OUTPUT;
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        if (\core_search\manager::is_global_search_enabled() === false) {
            $this->content->text = get_string('globalsearchdisabled', 'search');
            return $this->content;
        }

        $url = new moodle_url('/search/index.php');
        $this->content->footer .= html_writer::link($url, get_string('advancedsearch', 'search'));

        $this->content->text  = html_writer::start_tag('div', array('class' => 'searchform'));
        $this->content->text .= html_writer::start_tag('form', array('action' => $url->out()));
        $this->content->text .= html_writer::start_tag('fieldset', array('action' => 'invisiblefieldset'));

        // Input.
        $this->content->text .= html_writer::tag('label', get_string('search', 'search'),
            array('for' => 'searchform_search', 'class' => 'accesshide'));
        $inputoptions = array('id' => 'searchform_search', 'name' => 'q', 'class' => 'form-control',
            'type' => 'text', 'size' => '15');
        $this->content->text .= html_writer::empty_tag('input', $inputoptions);

        // Context id.
        if ($this->page->context && $this->page->context->contextlevel !== CONTEXT_SYSTEM) {
            $this->content->text .= html_writer::empty_tag('input', ['type' => 'hidden',
                    'name' => 'context', 'value' => $this->page->context->id]);
        }

        // Search button.
        $this->content->text .= html_writer::tag('button', get_string('search', 'search'),
            array('id' => 'searchform_button', 'type' => 'submit', 'title' => 'globalsearch', 'class' => 'btn btn-secondary'));
        $this->content->text .= html_writer::end_tag('fieldset');
        $this->content->text .= html_writer::end_tag('form');
        $this->content->text .= html_writer::end_tag('div');

        return $this->content;
    }
}
