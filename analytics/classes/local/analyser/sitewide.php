<?php
//

/**
 * Site-level contents abstract analysable.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics\local\analyser;

defined('MOODLE_INTERNAL') || die();

/**
 * Site-level contents abstract analysable.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class sitewide extends base {

    /**
     * Return the list of analysables to analyse.
     *
     * @param string|null $action 'prediction', 'training' or null if no specific action needed.
     * @param \context[] $contexts Ignored here.
     * @return \Iterator
     */
    public function get_analysables_iterator(?string $action = null, array $contexts = []) {
        // We can safely ignore $action as we have 1 single analysable element in this analyser.
        return new \ArrayIterator([new \core_analytics\site()]);
    }
}
