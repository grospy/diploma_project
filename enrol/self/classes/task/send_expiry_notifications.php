<?php
//

/**
 * Send expiry notifications task.
 *
 * @package   enrol_self
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_self\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Send expiry notifications task.
 *
 * @package   enrol_self
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class send_expiry_notifications extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('sendexpirynotificationstask', 'enrol_self');
    }

    /**
     * Run task for sending expiry notifications.
     */
    public function execute() {
        $enrol = enrol_get_plugin('self');
        $trace = new \text_progress_trace();
        $enrol->send_expiry_notifications($trace);
    }

}
