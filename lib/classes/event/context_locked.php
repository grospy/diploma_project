<?php
//

/**
 * Context locked event.
 *
 * @package    core_access
 * @copyright  2019 University of Nottingham
 * @author     Neill Magill <neill.magill@nottingham.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered after a context has been frozen.
 *
 * @package    core_access
 * @since      Moodle 3.8
 * @copyright  2019 University of Nottingham
 * @author     Neill Magill <neill.magill@nottingham.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class context_locked extends base {
    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' locked the context with id '$this->objectid' ";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcontextlocked', 'access');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        // Try to get the url for the context.
        try {
            $context = \context::instance_by_id($this->objectid);
            $url = $context->get_url();
        } catch (\dml_missing_record_exception $e) {
            // The context no longer exists, give them the system url instead.
            $url = \context_system::instance()->get_url();
        }
        return $url;
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'context';
    }
}
