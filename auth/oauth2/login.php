<?php
//

/**
 * Open ID authentication. This file is a simple login entry point for OAuth identity providers.
 *
 * @package auth_oauth2
 * @copyright 2017 Damyon Wiese
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

require_once('../../config.php');

$issuerid = required_param('id', PARAM_INT);
$wantsurl = new moodle_url(optional_param('wantsurl', '', PARAM_URL));

require_sesskey();

if (!\auth_oauth2\api::is_enabled()) {
    throw new \moodle_exception('notenabled', 'auth_oauth2');
}

$issuer = new \core\oauth2\issuer($issuerid);

$returnparams = ['wantsurl' => $wantsurl, 'sesskey' => sesskey(), 'id' => $issuerid];
$returnurl = new moodle_url('/auth/oauth2/login.php', $returnparams);

$client = \core\oauth2\api::get_user_oauth_client($issuer, $returnurl);

if ($client) {
    if (!$client->is_logged_in()) {
        redirect($client->get_login_url());
    }

    $auth = new \auth_oauth2\auth();
    $auth->complete_login($client, $wantsurl);
} else {
    throw new moodle_exception('Could not get an OAuth client.');
}

