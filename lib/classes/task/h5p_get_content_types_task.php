<?php
//

/**
 * Task to get the latest content types from the official H5P repository.
 *
 * @package    core
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

use core_h5p\factory;

defined('MOODLE_INTERNAL') || die();

/**
 * A task to get the latest content types from the official H5P repository.
 *
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class h5p_get_content_types_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('h5pgetcontenttypestask', 'admin');
    }

    /**
     * Get an \core_h5p\core instance.
     *
     * @return \core_h5p\core
     */
    public function get_core() {
        $factory = new factory();
        $core = $factory->get_core();
        return $core;
    }

    /**
     * Execute the task.
     */
    public function execute() {

        $core = $this->get_core();

        $result = $core->fetch_latest_content_types();

        if (!empty($result->error)) {
            mtrace($result->error);
        } else {
            $numtypesinstalled = count($result->typesinstalled);
            mtrace("{$numtypesinstalled} new content types installed");
        }
    }
}
