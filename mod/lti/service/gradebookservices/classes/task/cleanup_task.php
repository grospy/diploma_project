<?php
//

/**
 * A scheduled task for gradebookservices.
 *
 * @package    ltiservice_gradebookservices
 * @copyright  2017 Cengage Learning http://www.cengage.com
 * @author     Dirk Singels, Diego del Blanco, Claude Vervoort
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace ltiservice_gradebookservices\task;

use core\task\scheduled_task;
use ltiservice_gradebookservices\local\service\gradebookservices;

defined('MOODLE_INTERNAL') || die();

/**
 * Class containing the scheduled task for gradebookservices.
 *
 * @package    ltiservice_gradebookservices
 * @copyright  2017 Cengage Learning http://www.cengage.com
 * @author     Dirk Singels, Diego del Blanco, Claude Vervoort
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskcleanup', 'ltiservice_gradebookservices');
    }

    /**
     * Run forum cron.
     */
    public function execute() {
        gradebookservices::delete_orphans_ltiservice_gradebookservices_rows();
    }

}
