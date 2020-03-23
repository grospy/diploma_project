<?php
//

/**
 * Perform some custom name mapping for template file names (strip leading component/).
 *
 * @package    core
 * @category   output
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

use coding_exception;

/**
 * Perform some custom name mapping for template file names.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      2.9
 */
class mustache_filesystem_loader extends \Mustache_Loader_FilesystemLoader {

    /**
     * Provide a default no-args constructor (we don't really need anything).
     */
    public function __construct() {
    }

    /**
     * Helper function for getting a Mustache template file name.
     * Uses the leading component to restrict us specific directories.
     *
     * @param string $name
     * @return string Template file name
     */
    protected function getFileName($name) {
        // Call the Moodle template finder.
        return mustache_template_finder::get_template_filepath($name);
    }
}
