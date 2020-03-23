<?php
//

/**
 * Sync enrolments task
 * @package enrol_ldap
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_ldap\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Class sync_enrolments
 * @package enrol_ldap
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_enrolments extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('syncenrolmentstask', 'enrol_ldap');
    }

    /**
     * Run task for synchronising users.
     */
    public function execute() {

        if (!enrol_is_enabled('ldap')) {
            mtrace(get_string('pluginnotenabled', 'enrol_ldap'));
            exit(0); // Note, exit with success code, this is not an error - it's just disabled.
        }

        /** @var enrol_ldap_plugin $enrol */
        $enrol = enrol_get_plugin('ldap');

        $trace = new \text_progress_trace();

        // Update enrolments -- these handlers should autocreate courses if required.
        $enrol->sync_enrolments($trace);
    }

}
