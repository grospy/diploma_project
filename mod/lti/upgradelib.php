<?php
//

/**
 * This file contains functions used by upgrade and install.
 *
 * Because this is used during install it should not include additional files.
 *
 * @package   mod_lti
 * @copyright 2019 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * This function checks if a private key has been generated for this site.
 *
 * If the key does not exist it generates a new one. If the openssl
 * extension is not installed or configured properly it returns a warning message.
 *
 * @return string A warning message if a private key does not exist and cannot be generated.
 */
function mod_lti_verify_private_key() {
    $key = get_config('mod_lti', 'privatekey');

    // If we already generated a valid key, no need to check.
    if (empty($key)) {

        // Create the private key.
        $kid = bin2hex(openssl_random_pseudo_bytes(10));
        set_config('kid', $kid, 'mod_lti');
        $config = array(
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        $res = openssl_pkey_new($config);
        openssl_pkey_export($res, $privatekey);

        if (!empty($privatekey)) {
            set_config('privatekey', $privatekey, 'mod_lti');
        } else {
            return get_string('opensslconfiginvalid', 'mod_lti');
        }
    }

    return '';
}
