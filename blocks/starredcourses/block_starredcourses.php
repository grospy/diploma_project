<?php
//

/**
 * Starred courses block.
 *
 * @package   block_starredcourses
 * @copyright 2018 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Starred courses block definition class.
 *
 * @package   block_starredcourses
 * @copyright 2018 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_starredcourses extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_starredcourses');
    }

    /**
     * Gets the block contents.
     *
     * @return string The block HTML.
     */
    public function get_content() {

        if ($this->content !== null) {
            return $this->content;
        }

        $renderable = new \block_starredcourses\output\main();
        $renderer = $this->page->get_renderer('block_starredcourses');

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

    /**
     * Allow the block to have a configuration page
     *
     * @return boolean
     */
    public function has_config() {
        return true;
    }

    /**
     * Return the plugin config settings for external functions.
     *
     * @return stdClass the configs for both the block instance and plugin
     * @since Moodle 3.8
     */
    public function get_config_for_external() {
        // Return all settings for all users since it is safe (no private keys, etc..).
        $configs = get_config('block_starredcourses');

        return (object) [
            'instance' => new stdClass(),
            'plugin' => $configs,
        ];
    }
}
