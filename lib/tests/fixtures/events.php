<?php
//

/**
 * Test event handler definition used only from unit tests.
 *
 * @package    core
 * @subpackage event
 * @copyright  2007 onwards Martin Dougiamas (http://dougiamas.com)
 * @author     Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$handlers = array (
    'test_instant' => array (
        'handlerfile'      => '/lib/tests/eventslib_test.php',
        'handlerfunction'  => 'eventslib_sample_function_handler',
        'schedule'         => 'instant',
        'internal'         => 1,
    ),

    'test_cron' => array (
        'handlerfile'      => '/lib/tests/eventslib_test.php',
        'handlerfunction'  => array('eventslib_sample_handler_class', 'static_method'),
        'schedule'         => 'cron',
        'internal'         => 1,
    ),

    'test_legacy' => array (
        'handlerfile'      => '/lib/tests/event_test.php',
        'handlerfunction'  => '\core_tests\event\unittest_observer::legacy_handler',
        'schedule'         => 'instant',
        'internal'         => 1,
    ),

);

