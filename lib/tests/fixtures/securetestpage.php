<?php
//

/**
 * Fixture for testing secure layout pages have no nav link.
 *
 * @package core
 * @copyright 2019 Luca Bösch <luca.boesch@bfh.ch>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
// Behat test fixture only.
defined('BEHAT_SITE_RUNNING') || die('Only available on Behat test server');

$PAGE->set_pagelayout('secure');
$PAGE->set_url('/lib/tests/fixtures/securetestpage.php');
$PAGE->set_context(context_system::instance());

echo $OUTPUT->header();

echo $OUTPUT->heading('Hello world');

echo $OUTPUT->footer();
