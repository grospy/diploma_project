<?php

//

/**
 * This file is used to deliver a branch from the site administration
 * in XML format back to a page from an AJAX call
 *
 * @since Moodle 2.6
 * @package core
 * @copyright 2013 Rajesh Taneja <rajesh@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);
require_once(__DIR__ . '/../../config.php');

// This should be accessed by only valid logged in user.
require_login(null, false);

// This identifies the type of the branch we want to get. Make sure it's SITE_ADMIN.
$branchtype = required_param('type', PARAM_INT);
if ($branchtype !== navigation_node::TYPE_SITE_ADMIN) {
    throw new coding_exception('Incorrect node type passed');
}

// Start capturing output in case of broken plugins.
ajax_capture_output();

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/lib/ajax/getsiteadminbranch.php', array('type'=>$branchtype));

$sitenavigation = new settings_navigation_ajax($PAGE);

// Convert and output the branch as JSON.
$converter = new navigation_json();
$branch = $sitenavigation->get('root');

ajax_check_captured_output();
echo $converter->convert($branch);
