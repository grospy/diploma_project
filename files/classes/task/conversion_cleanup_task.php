<?php
//

/**
 * A scheduled task to clear up old conversion records.
 *
 * @package    core_files
 * @copyright  2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_files\task;

defined('MOODLE_INTERNAL') || die();

/**
 * A scheduled task to clear up old conversion records.
 *
 * @package    core_files
 * @copyright  2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class conversion_cleanup_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('fileconversioncleanuptask', 'admin');
    }

    /**
     * Run task.
     */
    public function execute() {
        \core_files\conversion::remove_old_conversion_records();
        \core_files\conversion::remove_orphan_records();
    }

}
