<?php
//

/**
 * Fixtures for task tests.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;
defined('MOODLE_INTERNAL') || die();

class adhoc_test_task extends \core\task\adhoc_task {
    public function execute() {
    }
}

class adhoc_test2_task extends \core\task\adhoc_task {
    public function execute() {
    }
}

class scheduled_test_task extends \core\task\scheduled_task {
    public function get_name() {
        return "Test task";
    }

    public function execute() {
    }
}

class scheduled_test2_task extends \core\task\scheduled_task {
    public function get_name() {
        return "Test task 2";
    }

    public function execute() {
    }
}

class scheduled_test3_task extends \core\task\scheduled_task {
    public function get_name() {
        return "Test task 3";
    }

    public function execute() {
    }
}
