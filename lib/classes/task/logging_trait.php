<?php
//

/**
 * This file defines a trait to assist with logging in tasks.
 *
 * @package    core
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

defined('MOODLE_INTERNAL') || die();

/**
 * This trait includes functions to assist with logging in tasks.
 *
 * @package    core
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
trait logging_trait {

    /**
     * @var \progress_trace
     */
    protected $trace = null;

    /**
     * @var \stdClass
     */
    protected $tracestats = null;

    /**
     * Get the progress_trace.
     *
     * @return  \progress_trace
     */
    protected function get_trace() {
        if (null === $this->trace) {
            $this->trace = new \text_progress_trace();
            $this->tracestats = new \stdClass();
        }

        return $this->trace;
    }

    /**
     * Log a message to the progress tracer.
     *
     * @param   string  $message
     * @param   int     $depth
     */
    protected function log($message, $depth = 1) {
        $this->get_trace()
            ->output($message, $depth);
    }

    /**
     * Log a start message to the progress tracer.
     *
     * @param   string  $message
     * @param   int     $depth
     */
    protected function log_start($message, $depth = 0) {
        $this->log($message, $depth);

        if (defined('MDL_PERFTOLOG') && MDL_PERFTOLOG) {
            $this->tracestats->$depth = [
                'mem' => memory_get_usage(),
                'time' => microtime(),
            ];
        }
    }

    /**
     * Log an end message to the progress tracer.
     *
     * @param   string  $message
     * @param   int     $depth
     */
    protected function log_finish($message, $depth = 0) {
        $this->log($message, $depth);

        if (isset($this->tracestats->$depth)) {
            $startstats = $this->tracestats->$depth;
            $this->log(
                    sprintf("Time taken %s, memory total: %s, Memory growth: %s, Memory peak: %s",
                        microtime_diff($startstats['time'], microtime()),
                        display_size(memory_get_usage()),
                        display_size(memory_get_usage() - $startstats['mem']),
                        display_size(memory_get_peak_usage())
                    ),
                    $depth + 1
                );
        }
    }
}
