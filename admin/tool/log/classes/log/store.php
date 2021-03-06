<?php
//

/**
 * Log store interface.
 *
 * @package    tool_log
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_log\log;

defined('MOODLE_INTERNAL') || die();

interface store {
    /**
     * Create new instance of store,
     * the calling code must make sure only one instance exists.
     *
     * @param manager $manager
     */
    public function __construct(\tool_log\log\manager $manager);

    /**
     * Notify store no more events are going to be written/read from it.
     * @return void
     */
    public function dispose();
}
