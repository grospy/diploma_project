<?php
//

/**
 * Time splitting method that generates predictions periodically.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics\local\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Time splitting method that generates predictions periodically.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class upcoming_periodic extends periodic implements after_now {

    /**
     * Gets the next range with start on the provided time.
     *
     * The next range is based on the upcoming period so we add this
     * range's periodicity to $time.
     *
     * @param  \DateTimeImmutable $time
     * @return array
     */
    protected function get_next_range(\DateTimeImmutable $time) {

        $start = $time->getTimestamp();
        $end = $time->add($this->periodicity())->getTimestamp();
        return [
            'start' => $start,
            'end' => $end,
            'time' => $start
        ];
    }

    /**
     * Whether to cache or not the indicator calculations.
     * @return bool
     */
    public function cache_indicator_calculations(): bool {
        return false;
    }

    /**
     * Overriden as these time-splitting methods are based on future dates.
     *
     * @return bool
     */
    public function valid_for_evaluation(): bool {
        return false;
    }

    /**
     * Get the start of the first time range.
     *
     * Overwriten to start generating predictions about upcoming stuff from time().
     *
     * @return int A timestamp.
     */
    protected function get_first_start() {
        global $DB;

        $cache = \cache::make('core', 'modelfirstanalyses');

        $key = $this->modelid . '_' . $this->analysable->get_id();
        $firstanalysis = $cache->get($key);
        if (!empty($firstanalysis)) {
            return $firstanalysis;
        }

        // This analysable has not yet been analysed, the start is therefore now.
        return time();
    }
}
