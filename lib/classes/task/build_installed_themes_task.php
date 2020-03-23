<?php
//

/**
 * Adhoc task that builds and caches all of the site's installed themes.
 *
 * @package    core
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Class that builds and caches all of the site's installed themes.
 *
 * @package     core
 * @copyright   2017 Ryan Wyllie <ryan@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class build_installed_themes_task extends adhoc_task {

    /**
     * Run the task.
     */
    public function execute() {
        global $CFG;
        require_once("{$CFG->libdir}/outputlib.php");

        $themenames = array_keys(\core_component::get_plugin_list('theme'));
        // Load the theme configs.
        $themeconfigs = array_map(function($themename) {
            return \theme_config::load($themename);
        }, $themenames);

        // Build the list of themes and cache them in local cache.
        theme_build_css_for_themes($themeconfigs);
    }
}
