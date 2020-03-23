<?php
//

/**
 * Contains the class for the Timeline block.
 *
 * @package    block_timeline
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Timeline block class.
 *
 * @package    block_timeline
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_timeline extends block_base {

    /**
     * Init.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_timeline');
    }

    /**
     * Returns the contents.
     *
     * @return stdClass contents of block
     */
    public function get_content() {
        if (isset($this->content)) {
            return $this->content;
        }

        $sort = get_user_preferences('block_timeline_user_sort_preference');
        $filter = get_user_preferences('block_timeline_user_filter_preference');
        $limit = get_user_preferences('block_timeline_user_limit_preference');

        $renderable = new \block_timeline\output\main($sort, $filter, $limit);
        $renderer = $this->page->get_renderer('block_timeline');

        $this->content = (object) [
            'text' => $renderer->render($renderable),
            'footer' => ''
        ];

        return $this->content;
    }

    /**
     * Locations where block can be displayed.
     *
     * @return array
     */
    public function applicable_formats() {
        return array('my' => true);
    }
}
