<?php
//

/**
 * Any element analysers can analyse.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics;

defined('MOODLE_INTERNAL') || die();

/**
 * Any element analysers can analyse.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface analysable {

    /**
     * Max timestamp.
     */
    const MAX_TIME = 9999999999;

    /**
     * The analysable unique identifier in the site.
     *
     * @return int.
     */
    public function get_id();

    /**
     * The analysable human readable name
     *
     * @return string
     */
    public function get_name();

    /**
     * The analysable context.
     *
     * @return \context
     */
    public function get_context();

    /**
     * The start of the analysable if there is one.
     *
     * @return int|false
     */
    public function get_start();

    /**
     * The end of the analysable if there is one.
     *
     * @return int|false
     */
    public function get_end();
}
