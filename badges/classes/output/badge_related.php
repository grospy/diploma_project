<?php
//

/**
 * Collection of all related badges.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

namespace core_badges\output;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/badgeslib.php');

use renderable;

/**
 * Collection of all related badges.
 *
 * @copyright  2018 Tung Thai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Tung Thai <Tung.ThaiDuc@nashtechglobal.com>
 */
class badge_related implements renderable {

    /** @var string how are the data sorted. */
    public $sort = 'name';

    /** @var string how are the data sorted. */
    public $dir = 'ASC';

    /** @var int page number to display. */
    public $page = 0;

    /** @var int number of badges to display per page. */
    public $perpage = BADGE_PERPAGE;

    /** @var int the total number of badges to display. */
    public $totalcount = null;

    /** @var int the current badge. */
    public $currentbadgeid = 0;

    /** @var array list of badges. */
    public $badges = array();

    /**
     * Initializes the list of badges to display.
     *
     * @param array $badges related badges to render.
     * @param int $currentbadgeid ID current badge.
     */
    public function __construct($badges, $currentbadgeid) {
        $this->badges = $badges;
        $this->currentbadgeid = $currentbadgeid;
    }
}

