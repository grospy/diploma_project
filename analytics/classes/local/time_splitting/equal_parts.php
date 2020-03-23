<?php
//

/**
 * X parts time splitting method.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics\local\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * X parts time splitting method.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class equal_parts extends base implements before_now {

    /**
     * Returns the number of parts the analyser duration should be split in.
     *
     * @return int
     */
    abstract protected function get_number_parts();

    /**
     * Splits the analysable duration in X equal parts from the start to the end.
     *
     * @return array
     */
    protected function define_ranges() {

        $nparts = $this->get_number_parts();

        $rangeduration = ($this->analysable->get_end() - $this->analysable->get_start()) / $nparts;

        if ($rangeduration < $nparts) {
            // It is interesting to avoid having a single timestamp belonging to multiple time ranges
            // because of things like community of inquiry indicators, where activities have a due date
            // that, ideally, would fall only into 1 time range. If the analysable duration is very short
            // it is because the model doesn't contain indicators that depend so heavily on time and therefore
            // we don't need to worry about timestamps being present in multiple time ranges.
            $allowmultipleranges = true;
        }

        $ranges = array();
        for ($i = 0; $i < $nparts; $i++) {
            $start = $this->analysable->get_start() + intval($rangeduration * $i);
            $end = $this->analysable->get_start() + intval($rangeduration * ($i + 1));

            if (empty($allowmultipleranges) && $i > 0 && $start === $ranges[$i - 1]['end']) {
                // We add 1 second so each timestamp only belongs to 1 range.
                $start = $start + 1;
            }

            if ($i === ($nparts - 1)) {
                // Better to use the end for the last one as we are using floor above.
                $end = $this->analysable->get_end();
            }
            $ranges[$i] = array(
                'start' => $start,
                'end' => $end,
                'time' => $end
            );
        }

        return $ranges;
    }
}
