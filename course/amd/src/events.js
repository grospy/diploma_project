//

/**
 * Contain the events the course component can trigger.
 *
 * @module     core_course/events
 * @package    core_course
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        favourited: 'core_course:favourited',
        unfavorited: 'core_course:unfavorited',
    };
});