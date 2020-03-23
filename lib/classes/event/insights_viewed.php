<?php
//

/**
 * Insights page viewed event.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string modelid: The model id
 * }
 *
 * @package    core_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered after a user views the insights page.
 *
 * @package    core_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class insights_viewed extends \core\event\base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        // It depends on the insight really.
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventinsightsviewed', 'analytics');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has viewed model '{$this->other['modelid']}' insights in " .
            "context with id '{$this->data['contextid']}'";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/report/insights/insights.php', array('modelid' => $this->other['modelid'],
            'contextid' => $this->data['contextid']));
    }
}
