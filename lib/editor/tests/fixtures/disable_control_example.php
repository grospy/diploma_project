<?php
//

/**
 * Demonstrates use of editor with enable/disable function.
 *
 * This fixture is only used by the Behat test.
 *
 * @package core_editor
 * @copyright 2018 Jake Hau <phuchau1509@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../../../config.php');
require_once('./editor_form.php');

// Behat test fixture only.
defined('BEHAT_SITE_RUNNING') || die('Only available on Behat test server');

// Require login.
require_login();

$PAGE->set_url('/lib/editor/tests/fixtures/disable_control_example.php');
$PAGE->set_context(context_system::instance());

// Create moodle form.
$mform = new editor_form();

echo $OUTPUT->header();

// Display moodle form.
$mform->display();

echo $OUTPUT->footer();
