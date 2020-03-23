<?php
//

/**
 * Keeps track of the analysis results by storing the results in an array.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics\local\analysis;

defined('MOODLE_INTERNAL') || die();

/**
 * Keeps track of the analysis results by storing the results in an array.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class result_array extends result {

    /**
     * Stores the analysis results by time-splitting method.
     * @var array
     */
    private $resultsbytimesplitting = [];

    /**
     * Stores the analysis results.
     * @param  array $results
     * @return bool            True if anything was successfully analysed
     */
    public function add_analysable_results(array $results): bool {

        $any = false;

        // Process all provided time splitting methods.
        foreach ($results as $timesplittingid => $result) {
            if (!empty($result->result)) {
                if (empty($this->resultsbytimesplitting[$timesplittingid])) {
                    $this->resultsbytimesplitting[$timesplittingid] = [];
                }
                $this->resultsbytimesplitting[$timesplittingid] += $result->result;
                $any = true;
            }
        }
        if (empty($any)) {
            return false;
        }
        return true;
    }

    /**
     * Formats the result.
     *
     * @param  array                                     $data
     * @param  \core_analytics\local\target\base         $target
     * @param  \core_analytics\local\time_splitting\base $timesplitting
     * @param  \core_analytics\analysable                $analysable
     * @return mixed The data as it comes
     */
    public function format_result(array $data, \core_analytics\local\target\base $target,
            \core_analytics\local\time_splitting\base $timesplitting, \core_analytics\analysable $analysable) {
        return $data;
    }

    /**
     * Returns the results of the analysis.
     * @return array
     */
    public function get(): array {

        // We join the datasets by time splitting method.
        $timesplittingresults = array();
        foreach ($this->resultsbytimesplitting as $timesplittingid => $results) {
            if (empty($timesplittingresults[$timesplittingid])) {
                $timesplittingresults[$timesplittingid] = [];
            }
            $timesplittingresults[$timesplittingid] += $results;
        }

        return $timesplittingresults;
    }
}