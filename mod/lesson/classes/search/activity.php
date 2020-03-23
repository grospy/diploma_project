<?php
//

/**
 * Search area for mod_lesson activities.
 *
 * @package    mod_lesson
 * @copyright  2015 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lesson\search;

defined('MOODLE_INTERNAL') || die();

/**
 * Search area for mod_lesson activities.
 *
 * @package    mod_lesson
 * @copyright  2015 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class activity extends \core_search\base_activity {

    /**
     * Returns true if this area uses file indexing.
     *
     * @return bool
     */
    public function uses_file_indexing() {
        return true;
    }

    /**
     * Return the context info required to index files for
     * this search area.
     *
     * @return array
     */
    public function get_search_fileareas() {
        $fileareas = array('intro', 'page_contents'); // Fileareas.

        return $fileareas;
    }
}
