<?php
//

/**
 * Exception handler for LTI services
 *
 * @package   mod_lti
 * @copyright Copyright (c) 2015 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lti;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/../locallib.php');
require_once(__DIR__.'/../servicelib.php');

/**
 * Handles exceptions when handling incoming LTI messages.
 *
 * Ensures that LTI always returns a XML message that can be consumed by the caller.
 *
 * @package   mod_lti
 * @copyright Copyright (c) 2015 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class service_exception_handler {
    /**
     * Enable error response logging.
     *
     * @var bool
     */
    protected $log = false;

    /**
     * The LTI service message ID, if known.
     *
     * @var string
     */
    protected $id = '';

    /**
     * The LTI service message type, if known.
     *
     * @var string
     */
    protected $type = 'unknownRequest';

    /**
     * Constructor.
     *
     * @param boolean $log Enable error response logging.
     */
    public function __construct($log) {
        $this->log = $log;
    }

    /**
     * Set the LTI message ID being handled.
     *
     * @param string $id
     */
    public function set_message_id($id) {
        if (!empty($id)) {
            $this->id = $id;
        }
    }

    /**
     * Set the LTI message type being handled.
     *
     * @param string $type
     */
    public function set_message_type($type) {
        if (!empty($type)) {
            $this->type = $type;
        }
    }

    /**
     * Echo an exception message encapsulated in XML.
     *
     * @param \Exception|\Throwable $exception The exception that was thrown
     */
    public function handle($exception) {
        $message = $exception->getMessage();

        // Add the exception backtrace for developers.
        if (debugging('', DEBUG_DEVELOPER)) {
            $message .= "\n".format_backtrace(get_exception_info($exception)->backtrace, true);
        }

        // Switch to response.
        $type = str_replace('Request', 'Response', $this->type);

        // Build the appropriate xml.
        $response = lti_get_response_xml('failure', $message, $this->id, $type);

        $xml = $response->asXML();

        // Log the request if necessary.
        if ($this->log) {
            lti_log_response($xml, $exception);
        }

        echo $xml;
    }
}
