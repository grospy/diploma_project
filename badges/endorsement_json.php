<?php
//
/**
 * Serve endorsement JSON for assertion.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2018 Tung Thai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Tung Thai <Tung.ThaiDuc@nashtechglobal.com>
 */
define('AJAX_SCRIPT', true);
define('NO_MOODLE_COOKIES', true); // No need for a session here.
require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/badgeslib.php');

if (empty($CFG->enablebadges)) {
    print_error('badgesdisabled', 'badges');
}

global $DB;
$id = required_param('id', PARAM_INT);
$action = optional_param('action', null, PARAM_BOOL); // Generates endorsement issuer class if true.
$badge = new badge($id);

$json = array();
$endorsement = $badge->get_endorsement();
$endorsementurl = new moodle_url('/badges/endorsement_json.php', array('id' => $id));

if ($endorsement) {
    $issuer = array();
    $issuerurl = new moodle_url('/badges/endorsement_json.php', array('id' => $id, 'action' => 1));
    $issuer['id'] = $issuerurl->out(false);
    $issuer['name'] = $endorsement->issuername;
    $issuer['email'] = $endorsement->issueremail;
    $issuer['url'] = $endorsement->issuerurl;
    if ($action) {
        $json = $issuer;
    } else {
        $json['@context'] = OPEN_BADGES_V2_CONTEXT;
        $json['type'] = OPEN_BADGES_V2_TYPE_ENDORSEMENT;
        $json['id'] = $endorsementurl->out(false);
        $json['issuer'] = $issuer;
        if (!empty($endorsement->claimcomment)) {
            $json['claim']['id'] = $endorsement->claimid;
            $json['claim']['endorsementComment'] = $endorsement->claimcomment;
        } else {
            $json['claim'] = $endorsement->claimid;
        }
        $json['issuedOn'] = date('c', $endorsement->dateissued);
        $json['verification'] = array('type' => 'hosted');
    }
}

echo $OUTPUT->header();
echo json_encode($json);
