<?php
//

/**
 * Data indexed event.
 *
 * @package    core
 * @copyright  2015 David Monllao - http://www.davidmonllao.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Event when new data has been indexed.
 *
 * @package    core
 * @since      Moodle 3.1
 * @copyright  2015 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_indexed extends base {

    /**
     * Initialise required event data properties.
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsearchindexed');
    }

    /**
     * Returns non-localised event description.
     *
     * @return string
     */
    public function get_description() {
        if (!empty($this->userid)) {
            return "The user with id '{$this->userid}' updated the search engine data";
        } else {
            return 'The search engine data has been updated';
        }
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/admin/searchareas.php');
    }
}
