<?php
//

/**
 * Installation code for the popup message processor
 *
 * @package   message_popup
 * @copyright 2009 Dongsheng Cai <dongsheng@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Install the popup message processor
 */
function xmldb_message_popup_install() {
    global $DB;

    $result = true;

    $provider = new stdClass();
    $provider->name  = 'popup';
    $DB->insert_record('message_processors', $provider);
    return $result;
}
