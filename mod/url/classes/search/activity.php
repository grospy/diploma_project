<?php
//

/**
 * Search area for mod_url activities.
 *
 * @package    mod_url
 * @copyright  2015 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_url\search;

defined('MOODLE_INTERNAL') || die();

/**
 * Search area for mod_url activities.
 *
 * @package    mod_url
 * @copyright  2016 Dan Poltawski
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
     * Returns the document associated with this activity.
     *
     * Overwrites base_activity to add the provided URL as description.
     *
     * @param stdClass $record
     * @param array    $options
     * @return \core_search\document
     */
    public function get_document($record, $options = array()) {
        $doc = parent::get_document($record, $options);
        if (!$doc) {
            return false;
        }

        $doc->set('description1', $record->externalurl);
        return $doc;
    }
}
