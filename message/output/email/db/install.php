<?php
//

/**
 * Installation code for the email message processor
 *
 * @package    message_email
 * @copyright  2009 Moodle Pty Ltd (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Install the email message processor
 */
function xmldb_message_email_install() {
    global $DB;
    $result = true;

    $provider = new stdClass();
    $provider->name  = 'email';
    $DB->insert_record('message_processors', $provider);
    return $result;
}
