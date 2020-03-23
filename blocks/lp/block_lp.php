<?php
//

/**
 * Block LP main file.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Block LP class.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_lp extends block_base {

    /**
     * Applicable formats.
     *
     * @return array
     */
    public function applicable_formats() {
        return array('site' => true, 'course' => true, 'my' => true);
    }

    /**
     * Init.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_lp');
    }

    /**
     * Get content.
     *
     * @return stdClass
     */
    public function get_content() {
        if (isset($this->content)) {
            return $this->content;
        }
        $this->content = new stdClass();

        if (!get_config('core_competency', 'enabled')) {
            return $this->content;
        }

        // Block needs a valid, non-guest user to be logged-in in order to display the user's learning plans.
        if (isloggedin() && !isguestuser()) {
            $summary = new \block_lp\output\summary();
            if (!$summary->has_content()) {
                return $this->content;
            }

            $renderer = $this->page->get_renderer('block_lp');
            $this->content->text = $renderer->render($summary);
            $this->content->footer = '';
        }

        return $this->content;
    }

}
