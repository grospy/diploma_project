<?php
//

/**
 * Listing of all sessions for current user.
 *
 * @package   report_usersessions
 * @copyright 2014 Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Petr Skoda <petr.skoda@totaralms.com>
 */

require(__DIR__ . '/../../config.php');

redirect(new moodle_url('/report/usersessions/user.php'));
