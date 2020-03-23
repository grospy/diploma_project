<?php
//

/**
 * phpmailer message sink.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2013 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * phpmailer message sink.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2013 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class phpunit_phpmailer_sink {
    /**
     * @var array of records which would have been sent by phpmailer.
     */
    protected $messages = array();

    /**
     * Stop message redirection.
     *
     * Use if you do not want message redirected any more.
     */
    public function close() {
        phpunit_util::stop_phpmailer_redirection();
    }

    /**
     * To be called from phpunit_util only!
     *
     * @param stdClass $message record from messages table
     */
    public function add_message($message) {
        /* Number messages from 0. */
        $this->messages[] = $message;
    }

    /**
     * Returns all redirected messages.
     *
     * The instances are records from the messages table.
     * The array indexes are numbered from 0 and the order is matching
     * the creation of events.
     *
     * @return array
     */
    public function get_messages() {
        return $this->messages;
    }

    /**
     * Return number of messages redirected to this sink.
     * @return int
     */
    public function count() {
        return count($this->messages);
    }

    /**
     * Removes all previously stored messages.
     */
    public function clear() {
        $this->messages = array();
    }
}
