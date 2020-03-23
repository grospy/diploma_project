<?php
//

/**
 * Mark a notification read and redirect to the relevant content.
 *
 * @package    message_popup
 * @copyright  2018 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

require_login(null, false);

if (isguestuser()) {
    redirect($CFG->wwwroot);
}

$notificationid = required_param('notificationid', PARAM_INT);

$notification = $DB->get_record('notifications', array('id' => $notificationid));

// If the redirect URL after filtering is empty, or it was never passed, then redirect to the notification page.
if (!empty($notification->contexturl)) {
    $redirecturl = new moodle_url($notification->contexturl);
} else {
    $redirecturl = new moodle_url('/message/output/popup/notifications.php', ['notificationid' => $notificationid]);
}

// Check notification belongs to this user.
if ($USER->id != $notification->useridto) {
    redirect($CFG->wwwroot);
}

\core_message\api::mark_notification_as_read($notification);
redirect($redirecturl);
