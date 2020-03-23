<?php
//

/**
 * The mod_glossary course module viewed event.
 *
 * @package    mod_glossary
 * @copyright  2014 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_glossary\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_glossary course module viewed event class.
 *
 * @property-read array $other {
 *     Extra information about event.
 *
 *     - string mode: (optional)
 * }
 *
 * @package    mod_glossary
 * @since      Moodle 2.7
 * @copyright  2014 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'glossary';
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        $params = array('id' => $this->contextinstanceid);
        if (!empty($this->other['mode'])) {
            $params['mode'] = $this->other['mode'];
        }
        return new \moodle_url("/mod/$this->objecttable/view.php", $params);
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    public function get_legacy_logdata() {
        // In moodle 2.6 and below the url was logged incorrectly, always having tab=-1 .
        return array($this->courseid, $this->objecttable, 'view',
            'view.php?id=' . $this->contextinstanceid . '&amp;tab=-1',
            $this->objectid, $this->contextinstanceid);
    }

    public static function get_objectid_mapping() {
        return array('db' => 'glossary', 'restore' => 'glossary');
    }

    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
