<?php
//

/**
 * Moodle PHPUnit integration
 *
 * @package    core
 * @category   phpunit
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: MOODLE_INTERNAL is not verified here because we load this before setup.php!

require_once(__DIR__.'/classes/util.php');
require_once(__DIR__.'/classes/event_mock.php');
require_once(__DIR__.'/classes/event_sink.php');
require_once(__DIR__.'/classes/message_sink.php');
require_once(__DIR__.'/classes/phpmailer_sink.php');
require_once(__DIR__.'/classes/base_testcase.php');
require_once(__DIR__.'/classes/basic_testcase.php');
require_once(__DIR__.'/classes/database_driver_testcase.php');
require_once(__DIR__.'/classes/arraydataset.php');
require_once(__DIR__.'/classes/advanced_testcase.php');
require_once(__DIR__.'/classes/hint_resultprinter.php'); // Loaded here because phpunit.xml does not support relative links for printerFile.
require_once(__DIR__.'/classes/constraint_object_is_equal_with_exceptions.php');
require_once(__DIR__.'/../testing/classes/test_lock.php');
require_once(__DIR__.'/../testing/classes/tests_finder.php');
