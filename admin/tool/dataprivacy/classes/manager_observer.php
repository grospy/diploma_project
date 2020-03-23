<?php
//

/**
 * Class \tool_dataprivacy\manager_observer.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy;
defined('MOODLE_INTERNAL') || die();

/**
 * A failure observer for the \core_privacy\manager.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager_observer implements \core_privacy\manager_observer {
    /**
     * Notifies all DPOs that an exception occurred.
     *
     * @param \Throwable $e
     * @param string $component
     * @param string $interface
     * @param string $methodname
     * @param array $params
     */
    public function handle_component_failure($e, $component, $interface, $methodname, array $params) {
        // Get the list of the site Data Protection Officers.
        $dpos = api::get_site_dpos();

        $messagesubject = get_string('exceptionnotificationsubject', 'tool_dataprivacy');
        $a = (object)[
            'fullmethodname' => \core_privacy\manager::get_provider_classname_for_component($component) . '::' . $methodname,
            'component' => $component,
            'message' => $e->getMessage(),
            'backtrace' => $e->getTraceAsString()
        ];
        $messagebody = get_string('exceptionnotificationbody', 'tool_dataprivacy', $a);

        // Email the data request to the Data Protection Officer(s)/Admin(s).
        foreach ($dpos as $dpo) {
            $message = new \core\message\message();
            $message->courseid          = SITEID;
            $message->component         = 'tool_dataprivacy';
            $message->name              = 'notifyexceptions';
            $message->userfrom          = \core_user::get_noreply_user();
            $message->subject           = $messagesubject;
            $message->fullmessageformat = FORMAT_HTML;
            $message->notification      = 1;
            $message->userto            = $dpo;
            $message->fullmessagehtml   = $messagebody;
            $message->fullmessage       = html_to_text($messagebody);

            // Send message.
            message_send($message);
        }
    }
}
