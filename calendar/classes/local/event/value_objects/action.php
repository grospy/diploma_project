<?php
//

/**
 * Class representing an action a user should take.
 *
 * @package    core_calendar
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\value_objects;

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\entities\action_interface;

/**
 * Class representing an action a user should take
 *
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class action implements action_interface {
    /**
     * @var string $name The action's name.
     */
    protected $name;

    /**
     * @var \moodle_url $url The action's URL.
     */
    protected $url;

    /**
     * @var int $itemcount How many items there are to action.
     */
    protected $itemcount;

    /**
     * @var bool $actionable Whether or not the event is currently actionable.
     */
    protected $actionable;

    /**
     * Constructor.
     *
     * @param string      $name       The action's name.
     * @param \moodle_url $url        The action's URL.
     * @param int         $itemcount  How many items there are to action.
     * @param bool        $actionable Whether or not the event is currently actionable.
     */
    public function __construct(
        $name,
        \moodle_url $url,
        $itemcount,
        $actionable
    ) {
        $this->name = $name;
        $this->url = $url;
        $this->itemcount = $itemcount;
        $this->actionable = $actionable;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_url() {
        return $this->url;
    }

    public function get_item_count() {
        return $this->itemcount;
    }

    public function is_actionable() {
        return $this->actionable;
    }
}
