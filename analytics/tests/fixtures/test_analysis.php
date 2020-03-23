<?php
//

/**
 * Test analyser.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test analyser.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_analysis extends \core_analytics\analysis {

    /**
     * Overwritten to add a delay.
     *
     * @param \core_analytics\analysable $analysable
     * @return array
     */
    public function process_analysable(\core_analytics\analysable $analysable): array {
        // Half a second.
        sleep(1);
        return parent::process_analysable($analysable);
    }
}
