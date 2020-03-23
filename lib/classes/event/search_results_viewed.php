<?php
//

/**
 * Search results viewed.
 *
 * @package    core
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Search results viewed.
 *
 * @property-read array $other {
 *      Extra information about event.
 *      - string q: (required) The search query.
 *      - int page: (required) The page number.
 *      - string title: (optional) Title filter.
 *      - string[] areaids: (optional) Search areas filter.
 *      - int[] courseids: (optional) Courses filter.
 *      - int timestart: (optional) Results from timestamp.
 *      - int timeend: (optional) Results to timestamp.
 * }
 *
 * @package    core
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_results_viewed extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsearchresultsviewed');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed page '{$this->other['page']}' of " .
            "'{$this->other['q']}' search results";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        $params = $this->other;

        // Skip search area and course filters (MDL-33188).
        if (isset($params['areaids'])) {
            unset($params['areaids']);
        }
        if (isset($params['courseids'])) {
            unset($params['courseids']);
        }
        return new \moodle_url('/search/index.php', $params);
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['q'])) {
            throw new \coding_exception('\'other\'[\'q\'] must be set.');
        }

        if (!isset($this->other['page'])) {
            throw new \coding_exception('\'other\'[\'page\'] must be set.');
        }

    }
}
