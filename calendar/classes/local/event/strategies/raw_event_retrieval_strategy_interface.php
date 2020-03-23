<?php
//

/**
 * Raw event strategy retrieval interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\strategies;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for an raw event retrival strategy class.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface raw_event_retrieval_strategy_interface {
    /**
     * Retrieve raw calendar event records from the DB.
     *
     * @param array|null    $usersfilter     Array of users to retrieve events for.
     * @param array|null    $groupsfilter    Array of groups to retrieve events for.
     * @param array|null    $coursesfilter   Array of courses to retrieve events for.
     * @param array|null    $categoriesfilter Array of categories to retrieve events for.
     * @param array|null    $whereconditions Array of where conditions to restrict results.
     * @param array|null    $whereparams     Array of parameters for $whereconditions.
     * @param string|null   $ordersql        SQL to order results.
     * @param int|null      $offset          Amount to offset results by.
     * @param int           $limitnum        Return at most this many results.
     * @param bool          $ignorehidden    True to ignore hidden events. False to include them.
     * @return \stdClass[] Array of event records.
     */
    public function get_raw_events(
        array $usersfilter = null,
        array $groupsfilter = null,
        array $coursesfilter = null,
        array $categoriesfilter = null,
        array $whereconditions = null,
        array $whereparams = null,
        $ordersql = null,
        $offset = null,
        $limitnum = 40,
        $ignorehidden = true
    );
}
