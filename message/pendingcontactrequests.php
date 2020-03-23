<?php
//

/**
 * This is a placeholder file for a legacy implementation.
 *
 * @package    core
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Disable moodle specific debug messages since we're just redirecting.
define('NO_DEBUG_DISPLAY', true);
require('../config.php');

require_login(null, false);

// We have a bunch of old notifications (both internal and external, e.g. email) that
// reference this URL which means we can't remove it so let's just redirect.
redirect("{$CFG->wwwroot}/message/index.php?view=contactrequests");
