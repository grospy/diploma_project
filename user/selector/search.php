<?php
//

/**
 * Code to search for users in response to an ajax call from a user selector.
 *
 * @package core_user
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/user/selector/lib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/user/selector/search.php');

echo $OUTPUT->header();

// Check access.
require_login();
require_sesskey();

// Get the search parameter.
$search = required_param('search', PARAM_RAW);

// Get and validate the selectorid parameter.
$selectorhash = required_param('selectorid', PARAM_ALPHANUM);
if (!isset($USER->userselectors[$selectorhash])) {
    print_error('unknownuserselector');
}

// Get the options.
$options = $USER->userselectors[$selectorhash];

// Create the appropriate userselector.
$classname = $options['class'];
unset($options['class']);
$name = $options['name'];
unset($options['name']);
if (isset($options['file'])) {
    require_once($CFG->dirroot . '/' . $options['file']);
    unset($options['file']);
}
$userselector = new $classname($name, $options);

// Do the search and output the results.
$results = $userselector->find_users($search);
$jsonresults = array();
foreach ($results as $groupname => $users) {
    $groupdata = array('name' => $groupname, 'users' => array());
    foreach ($users as $user) {
        $output = new stdClass;
        $output->id = $user->id;
        $output->name = $userselector->output_user($user);
        if (!empty($user->disabled)) {
            $output->disabled = true;
        }
        if (!empty($user->infobelow)) {
            $output->infobelow = $user->infobelow;
        }
        $groupdata['users'][] = $output;
    }
    $jsonresults[] = $groupdata;
}

$json = array('results' => $jsonresults);

// Also add users' group membership summaries, if possible.
if (is_callable(array($userselector, 'get_user_summaries')) && isset($options['courseid'])) {
    $json['userSummaries'] = $userselector->get_user_summaries($options['courseid']);
}

echo json_encode($json);
