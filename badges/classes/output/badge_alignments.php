<?php
//

/**
 * Issued badge renderable.
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
 * Link to external resources this badge is aligned with.
 *
 * @copyright  2018 Tung Thai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Tung Thai <Tung.ThaiDuc@nashtechglobal.com>
 */
class badge_alignments implements renderable {

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

    /** @var array list of badges. */
    public $alignments = array();

    /** @var array list of badges. */
    public $currentbadgeid = 0;

    /**
     * Initializes the list of alignments to display.
     *
     * @param array $alignments List alignments to render.
     * @param int $currentbadgeid ID current badge.
     */
    public function __construct($alignments, $currentbadgeid) {
        $this->alignments = $alignments;
        $this->currentbadgeid = $currentbadgeid;
    }
}
