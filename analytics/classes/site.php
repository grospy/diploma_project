<?php
//

/**
 * Moodle site analysable.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics;

defined('MOODLE_INTERNAL') || die();

/**
 * Moodle site analysable.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class site implements \core_analytics\analysable {

    /**
     * @var int
     */
    protected $start;

    /**
     * @var int
     */
    protected $end;

    /**
     * Analysable id
     *
     * @return int
     */
    public function get_id() {
        return SYSCONTEXTID;
    }

    /**
     * Site.
     *
     * @return string
     */
    public function get_name() {
        return get_string('site');
    }

    /**
     * Analysable context.
     *
     * @return \context
     */
    public function get_context() {
        return \context_system::instance();
    }

    /**
     * Analysable start timestamp.
     *
     * @return int
     */
    public function get_start() {
        if (!empty($this->start)) {
            return $this->start;
        }

        // Much faster than reading the first log in the site.
        $admins = get_admins();
        $this->start = 9999999999;
        foreach ($admins as $admin) {
            if ($admin->firstaccess < $this->start) {
                $this->start = $admin->firstaccess;
            }
        }
        return $this->start;
    }

    /**
     * Analysable end timestamp.
     *
     * @return int
     */
    public function get_end() {
        if (!empty($this->end)) {
            return $this->end;
        }

        $this->end = time();
        return $this->end;
    }
}
