<?php
//

/**
 * A scheduled task for lti module.
 *
 * @package    mod_lti
 * @copyright  2019 Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_lti\task;

use core\task\scheduled_task;

defined('MOODLE_INTERNAL') || die();

/**
 * Class containing the scheduled task for lti module.
 *
 * @package    mod_lti
 * @copyright  2018 Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class clean_access_tokens extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('cleanaccesstokens', 'mod_lti');
    }

    /**
     * Run lti cron.
     */
    public function execute() {
        global $DB;

        $DB->delete_records_select('lti_access_tokens', 'validuntil < ?', [time()]);
    }
}
