<?php
//
/**
 * Action related badges.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2018 Tung Thai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Tung Thai <Tung.ThaiDuc@nashtechglobal.com>
 */
require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/badgeslib.php');

$relatedid = optional_param('relatedid', 0, PARAM_INT); // Related badge ID.
$badgeid = optional_param('badgeid', 0, PARAM_INT); // Badge ID.
$action = optional_param('action', 'remove', PARAM_TEXT); // Add, remove option.

require_login();
$return = new moodle_url('/badges/related.php', array('id' => $badgeid));
$badge = new badge($badgeid);
$context = $badge->get_context();
require_capability('moodle/badges:configuredetails', $context);

if ($action == 'remove') {
    $badge->delete_related_badge($relatedid);
}

redirect($return);
