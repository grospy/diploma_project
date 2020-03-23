<?php
//

/**
 * Search area for mod_lti activities.
 *
 * @package    mod_lti
 * @copyright  2015 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lti\search;

defined('MOODLE_INTERNAL') || die();

/**
 * Search area for mod_lti activities.
 *
 * @package    mod_lti
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
}
