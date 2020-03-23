<?php
//

/**
 * Legacy workshop allocation plugins cron.
 *
 * @package     mod_workshop
 * @copyright   2018 Simey Lameze <simey@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_workshop\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Legacy workshop allocation plugins cron.
 *
 * @package     mod_workshop
 * @copyright   2018 Simey Lameze <simey@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class legacy_workshop_allocation_cron extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('legacyallocationplugincron', 'mod_workshop');
    }

    /**
     * Execute all workshop allocation methods plugins cron tasks.
     */
    public function execute() {
        cron_execute_plugin_type('workshopallocation', 'workshop allocation methods');
    }
}
