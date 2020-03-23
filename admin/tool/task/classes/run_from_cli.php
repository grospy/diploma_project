<?php
//

/**
 * Form for scheduled tasks admin pages.
 *
 * @package    tool_task
 * @copyright  2018 Toni Barbera <toni@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_task;

defined('MOODLE_INTERNAL') || die();

/**
 * Running tasks from CLI.
 *
 * @copyright  2018 Toni Barbera <toni@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class run_from_cli {

    /**
     * Find the path of PHP CLI binary.
     *
     * @return string|false The PHP CLI executable PATH
     */
    protected static function find_php_cli_path() {
        global $CFG;

        if (!empty($CFG->pathtophp) && is_executable(trim($CFG->pathtophp))) {
            return $CFG->pathtophp;
        }

        return false;
    }

    /**
     * Returns if Moodle have access to PHP CLI binary or not.
     *
     * @return bool
     */
    public static function is_runnable():bool {
        return self::find_php_cli_path() !== false;
    }

    /**
     * Executes a cron from web invocation using PHP CLI.
     *
     * @param \core\task\task_base $task Task that be executed via CLI.
     * @return bool
     * @throws \moodle_exception
     */
    public static function execute(\core\task\task_base $task):bool {
        global $CFG;

        if (!self::is_runnable()) {
            $redirecturl = new \moodle_url('/admin/settings.php', ['section' => 'systempaths']);
            throw new \moodle_exception('cannotfindthepathtothecli', 'tool_task', $redirecturl->out());
        } else {
            // Shell-escaped path to the PHP binary.
            $phpbinary = escapeshellarg(self::find_php_cli_path());

            // Shell-escaped path CLI script.
            $pathcomponents = [$CFG->dirroot, $CFG->admin, 'tool', 'task', 'cli', 'schedule_task.php'];
            $scriptpath     = escapeshellarg(implode(DIRECTORY_SEPARATOR, $pathcomponents));

            // Shell-escaped task name.
            $classname = get_class($task);
            $taskarg   = escapeshellarg("--execute={$classname}");

            // Build the CLI command.
            $command = "{$phpbinary} {$scriptpath} {$taskarg}";

            // Execute it.
            passthru($command);
        }

        return true;
    }
}
