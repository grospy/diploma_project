<?php
//

/**
 * Serve Issuer JSON for related badge or default Issuer if no badge is defined.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2020 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define('AJAX_SCRIPT', true);
define('NO_MOODLE_COOKIES', true); // No need for a session here.

require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/badgeslib.php');


$id = optional_param('id', null, PARAM_INT);

if (empty($id)) {
    // Get the default issuer for this site.
    $json = badges_get_default_issuer();
} else {
    // Get the issuer for this badge.
    $badge = new badge($id);
    if ($badge->status != BADGE_STATUS_INACTIVE) {
        $json = $badge->get_badge_issuer();
    } else {
        // The badge doen't exist or not accessible for the users.
        header("HTTP/1.0 410 Gone");
        $badgeurl = new moodle_url('/badges/issuer_json.php', array('id' => $id));
        $json = ['id' => $badgeurl->out()];
        $json['error'] = get_string('error:relatedbadgedoesntexist', 'badges');
    }
}

echo $OUTPUT->header();
echo json_encode($json);
